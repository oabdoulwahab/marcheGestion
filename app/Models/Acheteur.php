<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;


class Acheteur extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'activite',
        'addresse',
        'market_id',
    ];

    

    public function contrats()
{
    return $this->hasMany(Contrat::class);
}

}
