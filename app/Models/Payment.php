<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'date_payment',
        'marchant_id',
        'type_payment',
    ];

    // Relation avec Merchant
    public function merchant()
    {
        return $this->belongsTo(Marchant::class);
    }
}
