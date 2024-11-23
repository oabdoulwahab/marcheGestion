<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Récupération des meilleurs commerciaux
    $meilleursCommerciaux = Personnel::orderBy('chiffre_affaire', 'desc')->take(5)->get();

    // Calcul du chiffre d'affaires total
    $chiffreAffaire = Personnel::sum('chiffre_affaire');

    // Calcul des bénéfices
    $benefices = Finance::where('type', 'Profit')->sum('montant');

    // Calcul du total des articles vendus
    $totalArticles = Finance::count();

    // Données pour graphiques
    $ventesParMois = Finance::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')
                            ->groupBy('mois')
                            ->get();

    $ventesParRegion = Finance::selectRaw('region, SUM(montant) as total')
                              ->groupBy('region')
                              ->get();

    // Classements
    $meilleursClients = Finance::selectRaw('client, SUM(montant) as montant')
                               ->groupBy('client')
                               ->orderByDesc('montant')
                               ->take(5)
                               ->get();

    // Transmettre les données à la vue
    return view('pages.dashboard.index', [
        'chiffreAffaire' => $chiffreAffaire,
        'benefices' => $benefices,
        'totalArticles' => $totalArticles,
        'ventesParMois' => $ventesParMois,
        'ventesParRegion' => $ventesParRegion,
        'meilleursCommerciaux' => $meilleursCommerciaux,
        'meilleursClients' => $meilleursClients,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function secteur()
    {
        //
        return View('pages.secteur.index');

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
