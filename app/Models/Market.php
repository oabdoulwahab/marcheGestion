<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'country',
        'status',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    // Relation avec les utilisateurs
    public function users()
    {
        return $this->belongsToMany(User::class, 'market_user')
            ->withPivot('market_role')
            ->withTimestamps();
    }

    // Relation avec les secteurs
    public function secteurs()
    {
        return $this->hasMany(Secteur::class);
    }

    // Relation avec les marchants
    public function marchants()
    {
        return $this->hasMany(Marchant::class);
    }

    // Relation avec les espaces
    public function espaces()
    {
        return $this->hasMany(Espace::class);
    }
}