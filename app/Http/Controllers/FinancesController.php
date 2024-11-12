<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Finance = Finance::all();
        return View('pages.gesfin.index', compact('Finance'));

    }

    // Afficher un formulaire pour créer une nouvelle dépense
    public function create()
    {
        // Optionnel : retourner une vue pour créer une dépense
    }

    // Stocker une nouvelle dépense
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $Finance = Finance::create([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return response()->json($Finance, 201);
    }

    // Afficher une dépense spécifique
    public function show($id)
    {
        $Finance = Finance::findOrFail($id);
        return response()->json($Finance);
    }

    // Afficher un formulaire pour éditer une dépense
    public function edit($id)
    {
        // Optionnel : retourner une vue pour éditer une dépense
    }

    // Mettre à jour une dépense
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $Finance = Finance::findOrFail($id);
        $Finance->update([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return response()->json($Finance);
    }

    // Supprimer une dépense
    public function destroy($id)
    {
        $Finance = Finance::findOrFail($id);
        $Finance->delete();

        return response()->json(null, 204);
    }
}
