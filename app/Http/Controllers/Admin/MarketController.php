<?php

namespace App\Http\Controllers\Admin;

use App\Models\Espace;
use App\Models\Secteur;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        $secteurs = Secteur::withCount('marchants')->where('market_id', $marketId)->get();
        $totalMarchants = $secteurs->sum('marchants_count');

        $dataSecteurs = $secteurs->map(function ($secteur, $index) use ($totalMarchants, $secteurs) {
            $percentage = $totalMarchants > 0 
                ? ($secteur->marchants_count / $totalMarchants) * 100 
                : 0;

            // Ajuster le dernier élément à 100%
            if ($index === $secteurs->count() - 1) {
                $percentage = 100 - $secteurs->slice(0, $index)
                    ->sum(fn($s) => round(($s->marchants_count / $totalMarchants) * 100, 2));
            }

            return [
                'name' => $secteur->name,
                'count' => $secteur->marchants_count,
                'percentage' => round($percentage, 2),
            ];
        });

        $espaces = Espace::where('market_id', $marketId)->get();

        return view('pages.admin.market.dashboard.index', compact('secteurs', 'espaces', 'totalMarchants', 'dataSecteurs'));
    }
}
