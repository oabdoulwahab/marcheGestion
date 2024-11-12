<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personnels = Personnel::all();
        return View('pages.personnel.index',compact('personnels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        $personnels = Personnel::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'poste' => $request->poste,
            'contact' => $request->contact,
        ]);
        $personnels->save();

        return redirect()->back()->with('success', 'Un personnel ajouté avec succès');
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
    public function edit(string $id)
    {
        //
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
          
    $personnel = Personnel::findOrFail($id); // Récupère l'enregistrement ou lance une exception si introuvable
    
    $personnel->delete(); // Supprime l'enregistrement

    return redirect()->back()->with('success', 'Un personnel supprimé avec succès');; 
    }
}
