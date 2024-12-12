<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrat_name',
        'numero_contrat',
        'date_debut',
        'date_fin',
        'montant',
        'status',
        'vendeur_id',
        'acheteur_id',
    ];
    

    public function vendeur()
        {
            return $this->belongsTo(Vendeur::class);
        }

        public function acheteur()
        {
            return $this->belongsTo(Acheteur::class);
        }


    // Détermine et met à jour le statut du contrat
    public function updateStatus()
    {
        $currentDate = Carbon::now();

        if ($currentDate->lt($this->date_debut)) {
            $this->status = 'en attente';
        } elseif ($currentDate->between($this->date_debut, $this->date_fin)) {
            $this->status = 'actif';
        } elseif ($currentDate->gt($this->date_fin)) {
            $this->status = 'expiré';
        }

        $this->save();
    }

}
