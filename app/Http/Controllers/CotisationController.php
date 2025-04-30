<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Marchant;
use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //// Récupérer toutes les cotisations
    $cotisations = Cotisation::withCount('marchants')->latest()->get();

    // Récupérer toutes les finances et marchands (si nécessaire)
    $finances = Finance::all();
    $marchands = Marchant::all();
        return view('pages.admin.cotisation.cotisation.index', compact('marchands','cotisations'));
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
    // Enregistrer une nouvelle cotisation
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'montant_total' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        Cotisation::create($request->all());

        return redirect()->back()->with('success', 'Cotisation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupérer la cotisation avec ses adhérents paginés
        $cotisation = Cotisation::with(['marchants' => function ($query) {
            $query->orderBy('name'); // Trier par ordre alphabétique
        }])->findOrFail($id);

        // Paginer les adhérents (par exemple, 10 par page)
        $marchants = $cotisation->marchants()->paginate(10);

        // Calculer les montants pour chaque marchand
        $cotisation->marchants->each(function ($marchant) use ($cotisation) {
            // Calculer les montants basés sur les paiements de cette cotisation
            $montantTotal = $cotisation->montant_total;
            $montantDejaPaye = $marchant->paiements()->where('cotisation_id', $cotisation->id)->sum('montant');
            $resteAPayer = $montantTotal - $montantDejaPaye;

            // Ajouter ces données à l'objet marchand
            $marchant->montant_total_a_payer = $montantTotal;
            $marchant->montant_deja_paye = $montantDejaPaye;
            $marchant->reste_a_payer = $resteAPayer;
        });
        // Récupérer tous les adhérents sauf ceux déjà associés à la cotisation
        $marchands = Marchant::whereDoesntHave('cotisations', function ($query) use ($id) {
            $query->where('cotisation_id', $id);
        })->get();
        // Passer les données à la vue
        return view('pages.admin.cotisation.cotisation.show', compact('cotisation', 'marchands'));
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
    // Mettre à jour une cotisation
    public function update(Request $request, Cotisation $cotisation)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'montant_total' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $cotisation->update($request->all());

        return redirect()->back()->with('success', 'Cotisation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Supprimer une cotisation
    public function destroy(Cotisation $cotisation)
    {
        $cotisation->delete();

        return redirect()->route('cotisations.index')->with('success', 'Cotisation supprimée avec succès.');
    }

    public function addAdherents(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
           'adherents' => 'required|exists:marchants,id', // Vérifiez que les adhérents existent dans la table marchants
        ]);

        // Récupérer la cotisation
        $cotisation = Cotisation::findOrFail($id);

        // Ajouter les adhérents à la cotisation via la table pivot
        $cotisation->marchants()->syncWithoutDetaching($request->adherents);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Adhérents ajoutés avec succès.');
    }
    public function removeAdherent($cotisationId, $marchantId)
    {
        // Récupérer la cotisation
        $cotisation = Cotisation::findOrFail($cotisationId);

        // Dissocier l'adhérent de la cotisation
        $cotisation->marchants()->detach($marchantId);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Adhérent retiré de la cotisation avec succès.');
    }

    public function filterAdherentsByDate(Request $request, $cotisationId)
{
    $filter = $request->input('filter', 'all'); // Valeur par défaut : 'all'
    $query = Cotisation::findOrFail($cotisationId)->marchants()->with('paiements');

    switch ($filter) {
        case 'year':
            $query = $query->whereHas('paiements', function ($q) {
                $q->whereYear('date_payment', now()->year);
            });
            break;
        case 'month':
            $query = $query->whereHas('paiements', function ($q) {
                $q->whereYear('date_payment', now()->year)
                  ->whereMonth('date_payment', now()->month);
            });
            break;
        case 'week':
            $query = $query->whereHas('paiements', function ($q) {
                $q->whereBetween('date_payment', [now()->startOfWeek(), now()->endOfWeek()]);
            });
            break;
        case 'day':
            $query = $query->whereHas('paiements', function ($q) {
                $q->whereDate('date_payment', now());
            });
            break;
    }

    $marchants = $query->get();

    return response()->json($marchants);
}

}
