<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Cotisation extends Model
{
    use HasFactory , BelongsToMarket;
    protected $fillable = ['name', 'montant_total', 'date_debut', 'date_fin','market_id'];

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
