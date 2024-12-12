<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\ContratController;
use App\Http\Controllers\Admin\SecteurController;
use App\Http\Controllers\Admin\FinancesController;
use App\Http\Controllers\Admin\PersonnelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerchantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/bord', [DashboardController::class, 'index']); 
Route::get('/chart', [ChartController::class, 'index']); 
Auth::routes();
Route::middleware(['auth', 'role:agent,admin'])->group(function () {

    Route::resource('/',DashboardController::class );
    
    
        //routes pour les secteurs d'acivités 
        Route::resource('secteur', SecteurController::class);
    
       
        Route::resource('contrat', ContratController::class);
        Route::get('/contrat/{id}/export-pdf', [ContratController::class, 'exportPDF'])->name('contrat.export.pdf');
Route::get('/contrat/{id}/export-excel', [ContratController::class, 'exportExcel'])->name('contrat.export.excel');
    
        Route::resource('market', MarketController::class);
    
        Route::resource('/marchant',MerchantController::class);
     
    
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/',DashboardController::class );
    
    
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
    
        
     });
    

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
