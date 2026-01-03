<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Finance extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = [
        'name',
        'description',
        'type',
        'amount',
        'status',
    ];

    protected $attributes = [
        'type' => 'vente',
        'status' => 'En attente'
    ];

    // Méthode pour filtrer les finances par type
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
