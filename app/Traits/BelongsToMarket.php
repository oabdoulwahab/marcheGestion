<?php

namespace App\Traits;

trait BelongsToMarket
{
    // Cette méthode s'exécute automatiquement quand le modèle est utilisé
    protected static function bootBelongsToMarket()
    {
        // Ajoute un filtre automatique pour le marché courant
        static::addGlobalScope('market', function ($builder) {
            // Ne pas appliquer en console (migrations, seeders)
            if (!app()->runningInConsole() && session('current_market_id')) {
                $builder->where('market_id', session('current_market_id'));
            }
        });

        // Définir automatiquement le market_id à la création
        static::creating(function ($model) {
            if (session('current_market_id') && empty($model->market_id)) {
                $model->market_id = session('current_market_id');
            }
        });
    }

    // Relation avec Market (optionnelle, utile si pas déjà définie)
    // public function market()
    // {
    //     return $this->belongsTo(\App\Models\Market::class);
    // }
}