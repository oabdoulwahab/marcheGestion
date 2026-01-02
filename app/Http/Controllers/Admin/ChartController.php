<?php

namespace App\Http\Controllers\Admin;

use App\Models\Secteur;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        //
    }

    public function show(string $id)
    {
        $marketId = session('current_market_id');
        // Récupérer un secteur spécifique avec ses commerçants et leurs espaces
        $secteur = Secteur::with(['marchants.espace'])
            ->where('id', $id)
            ->where('market_id', $marketId)
            ->firstOrFail();

        // Retourner la vue avec les données du secteur
        return view('test', compact('secteur'));
    }
}
