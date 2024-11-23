<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\FinancesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonnelController;

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

Route::get('/', function () {
    return view('pages.dashboard.index');
});

// Route::middleware(['role:admin'])->group(function () {

//     // routes pour l'administrateur 
//     Route::prefix('admin/gestion/')->group(function () {
    //routes pour le tableau de bord
    // Route::resource('dashboard', DashboardController::class);

    Route::get('/chart', [ChartController::class, 'index']);
    //routes pour les secteurs d'acivités 
    Route::resource('secteur', SecteurController::class);

   
    Route::resource('contrat', ContratController::class);

    Route::resource('market', MarketController::class);

    //routes pour la gestion de Personnels
    Route::resource('personnel', PersonnelController::class);

    //routes pour la gestion de finances
    Route::resource('finance', FinancesController::class);
    Route::put('/finance/{id}/{status}', [FinancesController::class, 'updateStatus'])->name('finance.updateStatus');

//   });
// });

// Route::middleware(['role:user'])->group(function () {

     
   
    
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
