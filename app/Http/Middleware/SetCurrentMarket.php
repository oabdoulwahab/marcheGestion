<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SetCurrentMarket
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            $user = Auth::user();
            
            // Si pas de marché en session, prendre le premier
            if (!session()->has('current_market_id')) {
                $firstMarket = $user->markets()->first();
                if ($firstMarket) {
                    session(['current_market_id' => $firstMarket->id]);
                }
            }
            
            // Vérifier que l'utilisateur a accès au marché en session
            $currentMarketId = session('current_market_id');
            if ($currentMarketId) {
                $hasAccess = $user->markets()->where('market_id', $currentMarketId)->exists();
                if (!$hasAccess) {
                    // Si plus d'accès, prendre un autre marché
                    $anotherMarket = $user->markets()->first();
                    if ($anotherMarket) {
                        session(['current_market_id' => $anotherMarket->id]);
                    } else {
                        session()->forget('current_market_id');
                    }
                }
            }
        }
        
        return $next($request);
    }
}