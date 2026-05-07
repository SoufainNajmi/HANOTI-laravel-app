<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fournisseur;
use App\Models\Client;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('fournisseur', 'client')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:client,supplier,admin']);
        $user->update(['role' => $request->role]);

        // Créer automatiquement le profil associé si inexistant
        if ($request->role == 'supplier' && !$user->fournisseur) {
            Fournisseur::create(['user_id' => $user->id]);
        } elseif ($request->role == 'client' && !$user->client) {
            Client::create(['user_id' => $user->id]);
        }

        return redirect()->back()->with('success', 'Rôle mis à jour.');
    }
}
