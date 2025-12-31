<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToMarket;

class Personnel extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'poste',
        'ventes',
        'chiffre_affaire',
        'market_id',
    ];

    /**
     * Méthode pour calculer la performance d'un commercial (en pourcentage de ventes).
     */
    public function performance()
    {
        $totalVentes = Finance::sum('montant'); // Supposez que "Finance" a toutes les ventes
        return $totalVentes > 0 ? round(($this->chiffre_affaire / $totalVentes) * 100, 2) : 0;
    }
}
