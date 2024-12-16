<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
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
        // Récupérer les montants des contrats par mois et aujourd'hui
    $totalMontant = Contrat::sum('montant');
    $montantMois = Contrat::whereMonth('date_debut', now()->month)->sum('montant');
    $montantToday = Contrat::whereDate('date_debut', today())->sum('montant');

    // Récupérer les données pour le graphique (par exemple, montants mensuels)
    $data = Contrat::selectRaw('MONTH(date_debut) as month, sum(montant) as total')
                   ->groupBy('month')
                   ->orderBy('month')
                   ->get();
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

        $contrats = Contrat::all();

        // Exemple de calcul pour les statistiques

        $chartmontantMois = [50, 60, 70, 80, 90]; // Données mensuelles
        $chartmontantToday = [20, 30, 40]; // Données pour aujourd'hui
        $totalMontant = $contrats->sum('montant');
        $montantMois = $contrats->whereBetween('date_debut', [now()->startOfMonth(), now()->endOfMonth()])->sum('montant');
        $montantToday = $contrats->where('date_debut', now()->toDateString())->sum('montant');

        $totalContrats = Contrat::count();
        // $espacesAttribues = Espace::whereNotNull('marchant_id')->count();
        $nombreMarchants = Marchant::count();


        // Passer la donnée à la vue
        return view('pages.admin.dashboard.index', [
            'data' => $data,
            'totalSecteurs' => $totalSecteurs,
            'dataSecteurs' => $dataSecteurs,
            // 'espacesAttribues' => $espacesAttribues,
            'nombreMarchants' => $nombreMarchants,
            'totalMontant' => $totalMontant,
            'montantMois' => $montantMois,
            'montantToday' => $montantToday,
            'chartmontantMois' => $chartmontantMois,
            'chartmontantToday' => $chartmontantToday,
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
