<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable = ['montant_total', 'date_debut', 'date_fin'];

    // Relation many-to-many avec marchant
    public function marchants()
{
    return $this->belongsToMany(Marchant::class, 'cotisation_marchant')->withTimestamps();
}

    // Relation one-to-many avec Paiement
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
