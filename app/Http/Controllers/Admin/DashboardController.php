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

        // Initialisation des variables pour stocker les montants par date
        $dates = [];
        $montants = [];

        // Obtenir les dates des 7 derniers jours
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            // Calculer le montant total pour chaque date
            $totalForDate = Finance::whereDate('created_at', $date)->sum('amount')
                + Contrat::whereDate('created_at', $date)->sum('montant');
                // Remplacer 'espace_id' par le champ approprié si nécessaire

            $montants[] = $totalForDate;
        }
        // Récupérer tous les secteurs
        $finances = Finance::all();
        // Récupérer tous les contrats
        $contrats = Contrat::all();

        // Calculer les statuts dynamiques
        $totalContrats = $contrats->count();

        // Filtrer les contrats avec le statut 'actif' ou un autre statut pertinent
        $completedContrats = $contrats->filter(function ($contrat) {
            return $contrat->status === 'actif'; // Modifier selon le statut que vous ciblez
        })->count();

        // Calculer le pourcentage
        $percentage = $totalContrats > 0 ? ($completedContrats / $totalContrats) * 100 : 0;

        $contrat = [
            'percentage' => round($percentage, 2),
        ];

        // $espacesAttribues = Espace::whereNotNull('marchant_id')->count();
        $nombreMarchants = Marchant::count();

        $totalMarchants = $nombreMarchants > 0 ? $nombreMarchants * 2 : 100;
        // Éviter la division par zéro
        $percentage = $totalMarchants > 0 ? ($nombreMarchants / $totalMarchants) * 100 : 0;

        $Marchant = [
            'percentage' => $percentage,
        ];
        // Calculer le nombre total de secteurs
        $secteurs = Secteur::withCount('marchants')->get();
        $totalSecteurs = $secteurs->sum('marchants_count');
        $percentage = $totalMarchants > 0 ? ($nombreMarchants / $totalMarchants) * 100 : 0;

        $secteurpercent = [
            'percentage' => $percentage,
        ];
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Publications pour aujourd'hui
        $financesToday = Finance::whereDate('created_at', $today)->count();
        $contratsToday = Contrat::whereDate('created_at', $today)->count();
        $marchantsToday = Marchant::whereDate('created_at', $today)->count();

        // Publications pour la semaine
        $financesWeek = Finance::whereBetween('created_at', [$startOfWeek, $today])->count();
        $contratsWeek = Contrat::whereBetween('created_at', [$startOfWeek, $today])->count();
        $marchantsWeek = Marchant::whereBetween('created_at', [$startOfWeek, $today])->count();

        // Publications pour le mois
        $financesMonth = Finance::whereBetween('created_at', [$startOfMonth, $today])->count();
        $contratsMonth = Contrat::whereBetween('created_at', [$startOfMonth, $today])->count();
        $marchantsMonth = Marchant::whereBetween('created_at', [$startOfMonth, $today])->count();




        // Passer la donnée à la vue
        return view('pages.admin.dashboard.index', [
            'secteurpercent' => $secteurpercent,
            'financesToday' => $financesToday,
            'contratsToday' => $contratsToday,
            'marchantsToday' => $marchantsToday,
            'financesWeek' => $financesWeek,
            'contratsWeek' => $contratsWeek,
            'financesMonth' => $financesMonth,
            'contratsMonth' => $contratsMonth,
            'marchantsMonth' => $marchantsMonth,
            'marchantsWeek' => $marchantsWeek,
            'finances' => $finances,
            'contrat' => $contrat,
            'Marchant' => $Marchant,
            'totalSecteurs' => $totalSecteurs,
            // 'espacesAttribues' => $espacesAttribues,
            'nombreMarchants' => $nombreMarchants,
            'dates' => $dates,
            'montants' => $montants,
            'totalMontant' => array_sum($montants), // Montant total pour tous les jours
            'montantMois' => $this->getMonthlyTotal(),
            'montantToday' => $this->getTodayTotal(),
            'totalContrats' => $totalContrats
        ]);
    }



    // Calculer le montant total du mois courant
    private function getMonthlyTotal()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyTotal = Finance::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('amount')
            + Contrat::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('montant')
            + Marchant::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('espace_id');

        return $monthlyTotal;
    }

    // Calculer le montant total d'aujourd'hui
    private function getTodayTotal()
    {
        $today = Carbon::now()->format('Y-m-d');

        $todayTotal = Finance::whereDate('created_at', $today)->sum('amount')
            + Contrat::whereDate('created_at', $today)->sum('montant')
            + Marchant::whereDate('created_at', $today)->sum('espace_id');

        return $todayTotal;
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
