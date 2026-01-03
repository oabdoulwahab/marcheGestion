<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Marchant extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'secteur_id',
        'espace_id',
        'date_inscription',
    ];

    // Relation avec Market
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    // Relation many-to-many avec Cotisation
    public function cotisations()
    {
        return $this->belongsToMany(Cotisation::class, 'cotisation_marchant')->withTimestamps();
    }

    // Relation one-to-many avec Paiement
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
    // Relation avec Sector
    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    // Relation avec Espace
    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }

    public function montantTotalAPayer($cotisationId)
    {
        $cotisation = $this->cotisations()->find($cotisationId);
        return $cotisation ? $cotisation->montant_total : 0;
    }

    public function montantDejaPaye($cotisationId)
    {
        return $this->paiements()->where('cotisation_id', $cotisationId)->sum('montant');
    }

    public function resteAPayer($cotisationId)
    {
        return $this->montantTotalAPayer($cotisationId) - $this->montantDejaPaye($cotisationId);
    }
}
