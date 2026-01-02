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
        $marketId = session('current_market_id');
        $personnels = Personnel::where('market_id', $marketId)->get();
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
        $this->authorize('create', Personnel::class);
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
            'ventes' => $request->ventes,
            'chiffre_affaire' => $request->chiffre_affaire,
            'market_id' => session('current_market_id'),
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
          
        $personnel = Personnel::where('id', $id)->firstOrFail();
        $this->authorize('delete', $personnel);
        $personnel->delete();

    return redirect()->back()->with('success', 'Un personnel supprimé avec succès');; 
    }
}
