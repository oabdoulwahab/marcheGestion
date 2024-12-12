<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_space',
        'secteur_id',
        'status',
    ];

   
    
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
