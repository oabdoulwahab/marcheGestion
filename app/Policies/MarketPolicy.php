<?php

namespace App\Policies;

use App\Models\User;

class MarketPolicy
{
    /**
     * Autorisation globale pour tous les modèles ayant market_id
     */
    public function before(User $user, string $ability, $model = null)
    {
        // Autoriser toutes les actions si admin global
        if ($user->hasRole('super-admin')) {
            return true;
        }

        // Si le modèle n'existe pas (create)
        if (!$model) {
            return session()->has('current_market_id');
        }

        // Si le modèle a un market_id
        if (isset($model->market_id)) {
            return $model->market_id === session('current_market_id');
        }

        // Sinon Laravel continue (User, Market, etc.)
        return null;
    }
}

