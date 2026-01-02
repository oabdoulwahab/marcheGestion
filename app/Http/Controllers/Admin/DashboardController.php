<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Espace;
use App\Models\Contrat;
use App\Models\Finance;
use App\Models\Secteur;
use App\Models\Marchant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dates = [];
        $montants = [];
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;
            $montants[] = Finance::whereDate('created_at', $date)->sum('amount') +
                           Contrat::whereDate('created_at', $date)->sum('montant');
        }

        $contrats = Contrat::query()->get();
        $totalContrats = $contrats->count();
        $completedContrats = $contrats->where('status', 'actif')->count();
        $contratPercentage = $totalContrats > 0 ? round(($completedContrats / $totalContrats) * 100, 2) : 0;

        $nombreMarchants = Marchant::query()->count();
        $totalMarchants = max($nombreMarchants * 2, 100);
        $marchantPercentage = $totalMarchants > 0 ? ($nombreMarchants / $totalMarchants) * 100 : 0;

        $secteurs = Secteur::withCount('marchants')->get();
        $totalSecteurs = $secteurs->sum('marchants_count');

        $financesToday = Finance::whereDate('created_at', $today)->count();
        $contratsToday = Contrat::whereDate('created_at', $today)->count();
        $marchantsToday = Marchant::whereDate('created_at', $today)->count();

        $financesWeek = Finance::whereBetween('created_at', [$startOfWeek, $today])->count();
        $contratsWeek = Contrat::whereBetween('created_at', [$startOfWeek, $today])->count();
        $marchantsWeek = Marchant::whereBetween('created_at', [$startOfWeek, $today])->count();

        $financesMonth = Finance::whereBetween('created_at', [$startOfMonth, $today])->count();
        $contratsMonth = Contrat::whereBetween('created_at', [$startOfMonth, $today])->count();
        $marchantsMonth = Marchant::whereBetween('created_at', [$startOfMonth, $today])->count();

        return view('pages.admin.dashboard.index', [
            'secteurpercent' => ['percentage' => $marchantPercentage],
            'financesToday' => $financesToday,
            'contratsToday' => $contratsToday,
            'marchantsToday' => $marchantsToday,
            'financesWeek' => $financesWeek,
            'contratsWeek' => $contratsWeek,
            'financesMonth' => $financesMonth,
            'contratsMonth' => $contratsMonth,
            'marchantsMonth' => $marchantsMonth,
            'marchantsWeek' => $marchantsWeek,
            'finances' => Finance::all(),
            'contrat' => ['percentage' => $contratPercentage],
            'Marchant' => ['percentage' => $marchantPercentage],
            'totalSecteurs' => $totalSecteurs,
            'nombreMarchants' => $nombreMarchants,
            'dates' => $dates,
            'montants' => $montants,
            'totalMontant' => array_sum($montants),
            'montantMois' => $this->getMonthlyTotal(),
            'montantToday' => $this->getTodayTotal(),
            'totalContrats' => $totalContrats
        ]);
    }

    private function getMonthlyTotal()
    {
        return Finance::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('amount') +
               Contrat::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('montant');
    }

    private function getTodayTotal()
    {
        return Finance::whereDate('created_at', Carbon::today())->sum('amount') +
               Contrat::whereDate('created_at', Carbon::today())->sum('montant');
    }

    public function create()
    {
        return view('pages.profil.index');
    }

    public function store(Request $request) {}

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
