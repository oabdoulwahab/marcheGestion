<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\ContratController;
use App\Http\Controllers\Admin\SecteurController;
use App\Http\Controllers\Admin\FinancesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PersonnelController;

// Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/Admin',DashboardController::class );
    
    
        //routes pour les secteurs d'acivités 
        Route::resource('/secteur', SecteurController::class);
    
       
        Route::resource('contrat', ContratController::class);
    
        Route::resource('market', MarketController::class);
    
        //routes pour la gestion de Personnels
        Route::resource('personnel', PersonnelController::class);
    
        //routes pour la gestion de finances
        Route::resource('finance', FinancesController::class);
        Route::put('/finance/{id}/{status}', [FinancesController::class, 'updateStatus'])->name('finance.updateStatus');
    
    //   });
    // });
    
        
    //  });
    