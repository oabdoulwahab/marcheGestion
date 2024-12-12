<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marchant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'secteur_id',
        'contrat_id',
    ];

    // Relation avec Sector
    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    // Relation avec Contract
    public function contracts()
    {
        return $this->hasMany(Contrat::class);
    }

    // Relation avec Payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
