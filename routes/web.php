<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\Admin\{
    MarketController, 
    ContratController,
    SecteurController,
    FinancesController,
    PersonnelController,
    DashboardController,
    MerchantController,
    ChartController,
    EspaceController
};
use App\Http\Controllers\Admin\ContratController as AdminContratController;

Auth::routes();

// Routes publiques
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/chart', [ChartController::class, 'index'])->name('chart');

// Routes protégées
Route::middleware(['auth', 'setCurrentMarket'])->group(function () {

    /**
     * AGENT + ADMIN
     */
    Route::middleware(['role:agent|admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resources([
            'secteur'  => SecteurController::class,
            'contrat'  => AdminContratController::class,
            'market'   => MarketController::class,
            'marchant' => MerchantController::class,
            'espace'   => EspaceController::class,
        ]);

        // Exports contrats
        Route::prefix('contrat')->name('contrat.export.')->group(function () {
            Route::get('{contrat}/export-pdf', [ContratController::class, 'exportPDF'])->name('pdf');
            Route::get('{contrat}/export-excel', [ContratController::class, 'exportExcel'])->name('excel');
        });
    });

    /**
     * ADMIN SEULEMENT
     */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::resources([
            'personnel'  => PersonnelController::class,
            'finance'    => FinancesController::class,
            'cotisation' => CotisationController::class,
        ]);

        Route::post(
            'cotisation/add-adherents/{cotisation}',
            [CotisationController::class, 'addAdherents']
        )->name('cotisation.addAdherents');

        Route::put(
            'finance/{finance}/{status}',
            [FinancesController::class, 'updateStatus']
        )->name('finance.updateStatus');
    });
});
