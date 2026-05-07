<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['client_id', 'fournisseur_id', 'statut', 'date_commande'];

    protected $casts = [
        'date_commande' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produits')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

    public function commandeProduits()
    {
        return $this->hasMany(CommandeProduit::class);
    }
}
