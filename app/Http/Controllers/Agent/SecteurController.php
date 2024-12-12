<?php

namespace App\Http\Controllers\Agent;

use App\Models\Secteur;
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
        'description' => 'nullable|string',
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($secteur)
    {
        //
        return View('pages.agent.secteur.edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
