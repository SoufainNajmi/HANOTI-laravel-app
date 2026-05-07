<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminController;

// Routes protégées par auth
Route::middleware(['auth'])->group(function () {
    // Client
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
        Route::post('/commande', [ClientController::class, 'passerCommande'])->name('commande.passer');
        Route::get('/mes-commandes', [ClientController::class, 'mesCommandes'])->name('commandes');
    });

    // Fournisseur
    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/dashboard', [SupplierController::class, 'index'])->name('dashboard');
        Route::post('/produit', [SupplierController::class, 'ajouterProduit'])->name('produit.ajouter');
        Route::put('/produit/{id}', [SupplierController::class, 'modifierProduit'])->name('produit.modifier');
        Route::delete('/produit/{id}', [SupplierController::class, 'supprimerProduit'])->name('produit.supprimer');
        Route::post('/commande/{id}/traiter', [SupplierController::class, 'traiterCommande'])->name('commande.traiter');
    });

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/assign-role/{user}', [AdminController::class, 'assignRole'])->name('assign-role');
    });
});
require __DIR__.'/auth.php';
