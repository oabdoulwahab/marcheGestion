<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BelongsToMarket;

class Contrat extends Model
{
    use HasFactory, BelongsToMarket;
    protected $fillable = [
        'contrat_name',
        'numero_contrat',
        'date_debut',
        'date_fin',
        'montant',
        'status',
        'vendeur_id',
        'acheteur_id',
        'market_id',
    ];

    // Relation avec Market
    public function market()
    {
        return $this->belongsTo(Market::class);
    }
    

    public function vendeur()
        {
            return $this->belongsTo(Vendeur::class);
        }

        public function acheteur()
        {
            return $this->belongsTo(Acheteur::class);
        }


    // Détermine et met à jour le statut du contrat
    public function getStatusAttribute()
    {
        $currentDate = Carbon::now();

        if ($currentDate->lt($this->date_debut)) {
            return 'en attente';
        } elseif ($currentDate->between($this->date_debut, $this->date_fin)) {
            return 'actif';
        } elseif ($currentDate->gt($this->date_fin)) {
            return 'expiré';
        }
    }

}
