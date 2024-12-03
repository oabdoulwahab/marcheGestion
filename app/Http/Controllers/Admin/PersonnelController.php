<?php

namespace App\Http\Controllers\Admin;

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
        return View('pages.admin.personnel.index',compact('personnels'));
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
        // 'email' => 'required|string|max:255',
        'contact' => 'required|string|max:255',
        'poste' => 'required|string|max:255',
        'ventes' => 'required|string|max:255',
        'chiffre_affaire' => 'required|string|max:255',
           
        ]);

        $personnels = Personnel::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'poste' => $request->poste,
            'contact' => $request->contact,
            'ventes' => $request->prenom,
            'chiffre_affaire' => $request->poste,
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
