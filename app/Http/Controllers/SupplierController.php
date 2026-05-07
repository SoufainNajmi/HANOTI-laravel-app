<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;
//use App\Models\CommandeProduit;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $fournisseur = Auth::user()->fournisseur;
        $produits = Produit::where('fournisseur_id', $fournisseur->id)->get();
        $commandes = Commande::where('fournisseur_id', $fournisseur->id)
                            ->with('client.user', 'produits')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('supplier.dashboard', compact('produits', 'commandes'));
    }

    // Ajouter un produit
    public function ajouterProduit(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $fournisseur = Auth::user()->fournisseur;
        Produit::create([
            'fournisseur_id' => $fournisseur->id,
            'nom' => $request->nom,
            'prix' => $request->prix,
            'description' => $request->description,
        ]);

        return redirect()->route('supplier.dashboard')->with('success', 'Produit ajouté.');
    }

    // Modifier un produit
    public function modifierProduit(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
       // $this->authorize('update', $produit); // à définir si besoin

        $produit->update($request->only(['nom', 'prix', 'description']));
        return redirect()->route('supplier.dashboard')->with('success', 'Produit modifié.');
    }

    // Supprimer un produit
    public function supprimerProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('supplier.dashboard')->with('success', 'Produit supprimé.');
    }

    // Traiter une commande (marquer comme traitée)
    public function traiterCommande($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => 'processed']);
        return redirect()->route('supplier.dashboard')->with('success', 'Commande marquée comme traitée.');
    }
}
