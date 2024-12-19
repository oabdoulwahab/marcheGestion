<?php

namespace App\Http\Controllers\Agent;

use App\Models\Espace;
use App\Models\Secteur;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $secteurs = Secteur::all();

        // Calculer le nombre total de secteurs
        $totalMarchants = $secteurs->sum(function ($secteur) {
            return $secteur->marchants()->count();
        });

        $dataSecteurs = $secteurs->map(function ($secteur) use ($totalMarchants) {
            return [
                'name' => $secteur->name,
                'count' => $secteur->marchants()->count(),
                'rawPercentage' => $totalMarchants > 0 ? ($secteur->marchants()->count() / $totalMarchants) * 100 : 0,
            ];
        });

        // Ajustement final pour éviter les dépassements
        $totalPercentage = 0;
        $dataSecteurs = $dataSecteurs->map(function ($secteur, $index) use (&$totalPercentage, $dataSecteurs) {
            // Arrondi du pourcentage
            $lastElement = $index === $dataSecteurs->count() - 1;
            $roundedPercentage = round($secteur['rawPercentage'], 2);

            // Ajuster le dernier pourcentage pour garantir 100%
            if ($lastElement) {
                $roundedPercentage = 100 - $totalPercentage;
            }

            $totalPercentage += $roundedPercentage;

            return [
                'name' => $secteur['name'],
                'count' => $secteur['count'],
                'percentage' => $roundedPercentage,
            ];
        });
        $espaces = Espace::all();
        $secteurs = Secteur::withCount('marchants')->get();
        return View('pages.admin.market.dashboard.index', compact('secteurs','espaces', 'totalMarchants', 'dataSecteurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
