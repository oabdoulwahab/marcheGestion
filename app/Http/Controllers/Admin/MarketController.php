<?php

namespace App\Http\Controllers\Admin;

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
        $totalSecteurs = $secteurs->count();
    
        // Préparer les données avec les pourcentages
        $dataSecteurs = $secteurs->map(function ($secteur) use ($totalSecteurs) {
            return [
                'name' => $secteur->name,
                'count' => $secteur->marchants()->count(), // Exemple : le nombre de marchands par secteur
                'percentage' => $totalSecteurs > 0 ? round(($secteur->marchants()->count() / $totalSecteurs) * 100, 2) : 0,
            ];
        });
        $secteurs = Secteur::withCount('marchants')->get();
        return View('pages.admin.market.dashboard.index',compact('secteurs','$totalSecteurs','dataSecteurs'));
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
