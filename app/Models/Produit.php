<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['fournisseur_id', 'nom', 'description', 'prix'];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function commandeProduits()
    {
        return $this->hasMany(CommandeProduit::class);
    }
}
