<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acheteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'activite',
        'addresse',
    ];

    public function contrats()
{
    return $this->hasMany(Contrat::class);
}

}
