<?php

namespace App\Http\Controllers\Admin;

use App\Models\Finance;
use App\Models\Secteur;
use App\Models\Personnel;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function index(){
        // $personne = Personnel::all();
        // $finances = Finance::select('type', 'amount')->get();

        // $data = [['types', 'montant']];
        // foreach ($finances as $finances) {
        //     $data[] = [$finances->type, $finances->amount];
        // }
    
        // return view('test', compact('data'));
    }
    public function show(string $id)
{
    // Récupérer un secteur spécifique avec ses commerçants et leurs espaces
    $secteur = Secteur::with(['marchants.espace'])
        ->findOrFail($id);

    // Retourner la vue avec les données du secteur
    return view('test', compact('secteur'));
}

}
