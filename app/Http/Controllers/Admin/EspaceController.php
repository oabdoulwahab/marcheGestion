<?php

namespace App\Http\Controllers\Admin;

use App\Models\Espace;
use App\Models\Secteur;
use Illuminate\Http\Request;

class EspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $espaces = Espace::with('secteur')->get();
        // $secteurs = Secteur::all(); // Pour afficher les secteurs disponibles lors de l'ajout d'un espace
        return view('pages.admin.market.espace.espace', compact('espaces'));
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
// dd($request->all());
        // Validation des données d'entrée
        $request->validate([
            'numero_space' => 'required|unique:espaces,numero_space|max:255',
            // 'secteur_id' => 'required|exists:secteurs,id',
        ]);
        
        Espace::create([
            'numero_space' => $request->numero_space,
            // 'secteur_id' => $request->secteur_id,
            'status' => 'Disponible',
        ]);
        // dd($request->all());
        return redirect()->back()->with('success', 'Espace ajouté avec succès.');
    }

    /**
     * Met à jour un espace existant.
     */
    public function update(Request $request, Espace $espace)
    {
        // Validation des données d'entrée
        $request->validate([
            'numero_espace' => 'required|max:255|unique:espaces,numero_space,' . $espace->id,
            // 'secteur_id' => 'required|exists:secteurs,id',
        ]);

        // Mise à jour de l'espace
        $espace->update([
            'numero_espace' => $request->numero_space,
            // 'secteur_id' => $request->secteur_id,
        ]);
dd($espace);
        return redirect()->back()->with('success', 'Espace mis à jour avec succès.');
    }

    /**
     * Supprime un espace.
     */
    public function destroy(Espace $espace)
    {
        // Suppression de l'espace
        $espace->delete();

        return redirect()->back()->with('success', 'Espace supprimé avec succès.');
    }

    public function details($id)
    {
        // Récupérer les détails de l'espace en utilisant l'ID
        $espace = Espace::findOrFail($id);

        // Retourner une vue avec les données
        return view('pages.admin.market.espace.details', compact('espace'));
    }
}
