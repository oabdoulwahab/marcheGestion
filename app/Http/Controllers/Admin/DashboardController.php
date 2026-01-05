<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Contrat;
use App\Models\Finance;
use App\Models\Secteur;
use App\Models\Marchant;

class DashboardController extends Controller
{
    public function index()
    {
        $dates = [];
        $montants = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $dates[] = $date;

            $montants[] =
                Finance::whereDate('created_at', $date)->sum('amount') +
                Contrat::whereDate('created_at', $date)->sum('montant');
        }

        $contrats = Contrat::all();
        $totalContrats = $contrats->count();
        $activeContrats = $contrats->where('status', 'actif')->count();

        $contratPercentage = $totalContrats
            ? round(($activeContrats / $totalContrats) * 100, 2)
            : 0;

        $nombreMarchants = Marchant::count();
        $secteurs = Secteur::withCount('marchants')->get();

        return view('pages.admin.dashboard.index', [
            'dates'            => $dates,
            'montants'         => $montants,
            'totalMontant'     => array_sum($montants),
            'totalContrats'    => $totalContrats,
            'nombreMarchants'  => $nombreMarchants,
            'totalSecteurs'    => $secteurs->sum('marchants_count'),
            'contrat'          => ['percentage' => $contratPercentage],
            'montantToday'     => $this->getTodayTotal(),
            'montantMois'      => $this->getMonthlyTotal(),
        ]);
    }

    private function getMonthlyTotal()
    {
        return Finance::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('amount')
        +
        Contrat::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('montant');
    }

    private function getTodayTotal()
    {
        return Finance::whereDate('created_at', Carbon::today())->sum('amount')
        +
        Contrat::whereDate('created_at', Carbon::today())->sum('montant');
    }
}
