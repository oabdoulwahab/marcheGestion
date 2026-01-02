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
use App\Http\Controllers\Agent\AgentContratController;
use Illuminate\Support\Facades\Artisan;


Auth::routes();

// Route::get('/setup', function () {
//     // Exécute les migrations
//     Artisan::call('migrate', ['--force' => true]);

//     // Exécute les seeders
//     Artisan::call('db:seed', ['--force' => true]);

//     return 'Migrations et seeders exécutés avec succès !';
// });

// Public routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/chart', [ChartController::class, 'index'])->name('chart');

// Routes protégées par authentication
Route::middleware(['auth','setCurrentMarket'])->group(function () {
    
    // Routes communes aux agents et admins
    Route::middleware(['role:agent,admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resources([
            'secteur' => SecteurController::class,
            'contrat' => AdminContratController::class,
            'market' => MarketController::class,
            'marchant' => MerchantController::class,
            'espace' => EspaceController::class,
        ]);

        // Export routes
        Route::prefix('contrat')->name('contrat.export.')->group(function () {
            Route::get('{id}/export-pdf', [ContratController::class, 'exportPDF'])->name('pdf');
            Route::get('{id}/export-excel', [ContratController::class, 'exportExcel'])->name('excel');
        });
    });

    // Routes réservées aux admins
    Route::middleware(['role:admin,agent'])->prefix('admin')->name('admin.')->group(function () {
        Route::resources([
            'personnel' => PersonnelController::class,
            'finance' => FinancesController::class,
            'cotisation' => CotisationController::class
        ]);
        Route::post('cotisation/addAdherents',[CotisationController::class,'addAdherents'])->name('cotisation.addAdherents');
        Route::put('finance/{id}/{status}', [FinancesController::class, 'updateStatus'])
            ->name('finance.updateStatus');
    });
});
