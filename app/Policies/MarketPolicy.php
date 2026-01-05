<?php

namespace App\Policies;

use App\Models\User;

class MarketPolicy
{
    /**
     * Autorisation globale pour tous les modèles avec market_id
     */
    public function before(User $user, string $ability, $model = null)
    {
        // Super admin = accès total
        if ($user->hasRole('super-admin')) {
            return true;
        }

        // Create (pas encore de modèle)
        if (!$model) {
            return auth()->check() && session()->has('current_market_id');
        }

        // Modèle avec market_id
        if (isset($model->market_id)) {
            return $model->market_id === session('current_market_id');
        }

        return null;
    }
}
