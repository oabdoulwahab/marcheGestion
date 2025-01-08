<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = ['marchant_id', 'cotisation_id', 'montant', 'date_paiement'];

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
