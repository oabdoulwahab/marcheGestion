<?php

namespace App\Http\Controllers\Admin;


use App\Models\Espace;
use App\Models\Contrat;
use App\Models\Finance;
use App\Models\Secteur;
use App\Models\Marchant;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class DashboardController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Compter les secteurs d'activité
    // Récupérer tous les secteurs
    $secteurs = Secteur::all();

    // Calculer le nombre total de secteurs
    $totalSecteurs =  $secteurs->count();

    // Préparer les données avec les pourcentages
    $dataSecteurs = $secteurs->map(function ($secteur) use ($totalSecteurs) {
        return [
            'name' => $secteur->name,
            'count' => $secteur->marchants()->count(), // Exemple : le nombre de marchands par secteur
            'percentage' => $totalSecteurs > 0 ? round(($secteur->marchants()->count() / $totalSecteurs) * 100, 2) : 0,
        ];
    });

    
    $totalContrats = Contrat::count();
    $espacesAttribues = Espace::whereNotNull('marchant_id')->count();
    $nombreMarchants = Marchant::count();


    // Passer la donnée à la vue
    return view('pages.admin.dashboard.index', [
        'totalSecteurs' => $totalSecteurs,
        'dataSecteurs' => $dataSecteurs,
        'espacesAttribues' => $espacesAttribues,
        'nombreMarchants' => $nombreMarchants,
        'totalContrats' => $totalContrats
    ]);
    
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('pages.profil.index');

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
