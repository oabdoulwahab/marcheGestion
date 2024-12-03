<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_contrat',
        'date_debut',
        'date_fin',
        'montant',
        'marchant_id',
    ];

    // Relation avec Merchant
    public function marchant()
    {
        return $this->belongsTo(Marchant::class);
    }
}
