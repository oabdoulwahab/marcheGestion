<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use App\Models\Secteur;

class MarketController extends Controller
{
    public function index()
    {
        // Déjà filtré automatiquement par le marché courant
        $secteurs = Secteur::withCount('marchants')->get();
        $espaces  = Espace::all();

        $totalMarchants = $secteurs->sum('marchants_count');

        $dataSecteurs = [];
        $percentageSum = 0;

        foreach ($secteurs as $index => $secteur) {
            $percentage = $totalMarchants > 0
                ? ($secteur->marchants_count / $totalMarchants) * 100
                : 0;

            // Ajustement du dernier élément pour arriver à 100%
            if ($index === $secteurs->count() - 1) {
                $percentage = 100 - $percentageSum;
            }

            $percentage = round($percentage, 2);
            $percentageSum += $percentage;

            $dataSecteurs[] = [
                'name'       => $secteur->name,
                'count'      => $secteur->marchants_count,
                'percentage' => $percentage,
            ];
        }

        return view(
            'pages.agent.market.dashboard.index',
            compact('secteurs', 'espaces', 'totalMarchants', 'dataSecteurs')
        );
    }
}
