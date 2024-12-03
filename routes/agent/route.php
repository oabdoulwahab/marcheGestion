<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\ChartController;
use App\Http\Controllers\Agent\MarketController;
use App\Http\Controllers\Agent\ContratController;
use App\Http\Controllers\Agent\SecteurController;
use App\Http\Controllers\Agent\FinancesController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\PersonnelController;

Route::middleware(['auth', 'role:agent,admin'])->group(function () {
Route::middleware(['auth'])->group(function () {
    Route::resource('/',DashboardController::class );
    
    
        //routes pour les secteurs d'acivités 
        Route::resource('secteur', SecteurController::class);
    
       
        Route::resource('contrat', ContratController::class);
    
        Route::resource('market', MarketController::class);
    
        
     });
    
});