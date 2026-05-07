<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Commande;
use App\Models\CommandeProduit;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        // Récupérer la liste des fournisseurs avec leurs produits
        $fournisseurs = Fournisseur::with('produits')->get();
        return view('client.dashboard', compact('fournisseurs'));
    }

    public function passerCommande(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'produits' => 'required|array',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        $client = Auth::user()->client;
        if (!$client) {
            return redirect()->back()->with('error', 'Vous devez être client pour commander.');
        }

        // Créer la commande
        $commande = Commande::create([
            'client_id' => $client->id,
            'fournisseur_id' => $request->fournisseur_id,
            'statut' => 'pending',
            'date_commande' => now(),
        ]);

        // Ajouter les produits à la commande
        foreach ($request->produits as $produitData) {
            CommandeProduit::create([
                'commande_id' => $commande->id,
                'produit_id' => $produitData['id'],
                'quantite' => $produitData['quantite'],
            ]);
        }

        return redirect()->route('client.dashboard')->with('success', 'Commande passée avec succès !');
    }

    public function mesCommandes()
    {
        $client = Auth::user()->client;
        $commandes = Commande::where('client_id', $client->id)
                            ->with('fournisseur', 'produits')
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('client.commandes', compact('commandes'));
    }
}
