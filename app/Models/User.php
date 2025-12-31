<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address',
        // Retirer 'role' et 'role_id' car Spatie Permission les gère déjà
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ========== RELATIONS POUR LE MULTI-MARCHÉS ==========
    
    // Relation many-to-many avec markets
    public function markets()
    {
        return $this->belongsToMany(Market::class, 'market_user')
                    ->withPivot('market_role') // J'ai changé 'role' en 'market_role' pour éviter conflit
                    ->withTimestamps();
    }

    // Vérifie si l'utilisateur a un rôle spécifique dans un marché
    public function hasMarketRole($marketId, $role)
    {
        return $this->markets()
                    ->where('market_id', $marketId)
                    ->wherePivot('market_role', $role)
                    ->exists();
    }

    // Récupère le rôle de l'utilisateur dans un marché spécifique
    public function getMarketRole($marketId)
    {
        $market = $this->markets()->where('market_id', $marketId)->first();
        return $market ? $market->pivot->market_role : null;
    }

    // Récupère le marché courant (depuis la session)
    public function currentMarket()
    {
        $marketId = session('current_market_id');
        if ($marketId) {
            return $this->markets()->where('market_id', $marketId)->first();
        }
        return $this->markets()->first(); // Premier marché par défaut
    }

    // Vérifie si l'utilisateur est admin d'un marché
    public function isMarketAdmin($marketId = null)
    {
        if (!$marketId) {
            $marketId = session('current_market_id');
        }
        
        if (!$marketId) return false;
        
        return $this->hasMarketRole($marketId, 'admin');
    }

    // Scope pour filtrer par marché
    public function scopeForMarket($query, $marketId)
    {
        return $query->whereHas('markets', function($q) use ($marketId) {
            $q->where('market_id', $marketId);
        });
    }

    // Méthode pour changer de rôle dans un marché
    public function setMarketRole($marketId, $role)
    {
        if ($this->markets()->where('market_id', $marketId)->exists()) {
            $this->markets()->updateExistingPivot($marketId, ['market_role' => $role]);
        } else {
            $this->markets()->attach($marketId, ['market_role' => $role]);
        }
    }
}