<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use App\Models\Secteur;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        $secteurs = Secteur::withCount('marchants')->where('market_id', $marketId)->get();
        $espaces = Espace::where('market_id', $marketId)->get();
        
        $totalMarchants = $secteurs->sum('marchants_count');
        
        $dataSecteurs = $secteurs->map(function ($secteur, $index) use ($secteurs, $totalMarchants) {
            $percentage = $totalMarchants > 0 
                ? ($secteur->marchants_count / $totalMarchants) * 100 
                : 0;
            
            // Adjust last element to ensure 100%
            if ($index === $secteurs->count() - 1) {
                $percentage = 100 - $dataSecteurs->sum('percentage');
            }
            
            return [
                'name' => $secteur->name,
                'count' => $secteur->marchants_count,
                'percentage' => round($percentage, 2),
            ];
        });

        return view('pages.agent.market.dashboard.index', compact('secteurs', 'espaces', 'totalMarchants', 'dataSecteurs'));
    }
}
