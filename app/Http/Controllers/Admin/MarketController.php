<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use App\Models\Secteur;

class MarketController extends Controller
{
    public function index()
    {
        // Tous les secteurs du marché courant (filtrés automatiquement)
        $secteurs = Secteur::withCount('marchants')->get();

        $totalMarchants = $secteurs->sum('marchants_count');

        $dataSecteurs = $secteurs->values()->map(function ($secteur, $index) use ($totalMarchants, $secteurs) {
            $percentage = $totalMarchants > 0
                ? ($secteur->marchants_count / $totalMarchants) * 100
                : 0;

            // Ajuster le dernier élément à 100 %
            if ($index === $secteurs->count() - 1 && $totalMarchants > 0) {
                $percentage = 100 - $secteurs->slice(0, $index)
                    ->sum(fn ($s) => round(($s->marchants_count / $totalMarchants) * 100, 2));
            }

            return [
                'name'       => $secteur->name,
                'count'      => $secteur->marchants_count,
                'percentage' => round($percentage, 2),
            ];
        });

        // Espaces du marché courant (filtrés automatiquement)
        $espaces = Espace::all();

        return view(
            'pages.admin.market.dashboard.index',
            compact('secteurs', 'espaces', 'totalMarchants', 'dataSecteurs')
        );
    }
}
