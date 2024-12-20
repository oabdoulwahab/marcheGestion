<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
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
}
