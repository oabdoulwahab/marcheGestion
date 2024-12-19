<?php

namespace App\Http\Controllers\Agent;

use Exception;
use App\Models\Secteur;
use App\Models\Marchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
    $secteurs = Secteur::with('user')->get();
    return View('pages.agent.secteur.index',compact('secteurs'));

}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    //
    return View('pages.agent.secteur.create');

}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    //

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'string|max:255|nullable',
    ]);

    Secteur::create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'user_id' => Auth::id(), // Enregistre l'utilisateur connecté
    ]);

    return redirect()->route('secteur.index')->with('success', 'Secteur créé avec succès.');
}


/**
 * Display the specified resource.
 */
public function show(string $id)
{
    //
    $marchand = Marchant::findOrFail($id);
    return view('pages.agent.market.marchant.show',compact('marchand'));
}

/**
 * Show the form for editing the specified resource.
 */
public function edit($id)
{
    //
    $secteur=Secteur::findOrFail($id);
    return View('pages.admin.secteur.edit',compact('secteur'));

}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
// Validation des données du formulaire
$validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string|max:1000',
]);

try {
    // Récupérer le secteur à mettre à jour
    $secteur = Secteur::findOrFail($id);

    // Mettre à jour les champs avec les données validées
    $secteur->update([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
    ]);

    // Redirection avec un message de succès
    return redirect()
        ->route('secteur.index')
        ->with('success', 'Le secteur a été mis à jour avec succès.');
} catch (Exception $e) {
    // En cas d'erreur, redirection avec un message d'erreur
    return redirect()
        ->back()
        ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour du secteur.'])
        ->withInput();
}
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
