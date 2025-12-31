<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Espace extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = [
        'numero_space',
        'secteur_id',
        'status',
        'market_id', 
    ];

   
    // Relation avec Market
    public function market()
    {
        return $this->belongsTo(Market::class);
    }
    
    // Relation avec Secteur
    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    // Relation avec Marchant
    public function marchant()
    {
        return $this->hasMany(Marchant::class);
    }
}
