<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Vendeur extends Model
{
    use HasFactory, BelongsToMarket;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'addresse',
        'market_id',
    ];

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

}
