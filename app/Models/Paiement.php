<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Paiement extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = ['marchant_id', 'cotisation_id', 'montant', 'date_paiement','market_id'];

   // Relation many-to-one avec Marchant
   public function marchant()
{
    return $this->belongsTo(Marchant::class);
}

public function cotisation()
{
    return $this->belongsTo(Cotisation::class);
}
}
