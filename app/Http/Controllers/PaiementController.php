<?php

namespace App\Http\Controllers;

use App\Models\Marchant;
use App\Models\Paiement;
use App\Models\Cotisation;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Récupérer tous les adhérents avec leurs cotisations et paiements
        $marchants = Marchant::with(['cotisations', 'paiements'])->get();

        // Calculer le montant total à payer par adhérent pour chaque cotisation
        $marchants->each(function ($marchant) {
            $marchant->cotisations->each(function ($cotisation) use ($marchant) {
                $montantTotal = $cotisation->montant_total;
                $montantDejaPaye = $marchant->paiements
                    ->where('cotisation_id', $cotisation->id)
                    ->sum('montant');
                $resteAPayer = $montantTotal - $montantDejaPaye;

                // Ajouter ces données à l'objet cotisation
                $cotisation->montant_total_a_payer = $montantTotal;
                $cotisation->montant_deja_paye = $montantDejaPaye;
                $cotisation->reste_a_payer = $resteAPayer;
            });
        });

        $paiements = Paiement::with(['marchant', 'cotisation'])->get();
        return view('pages.admin.cotisation.paiment.show', compact('paiements', 'marchants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $marchants = Marchant::all();
        $cotisations = Cotisation::all();
        return view('pages.admin.cotisation.paiment.create', compact('marchants', 'cotisations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'marchant_id' => 'required|exists:marchants,id',
        'cotisation_id' => 'required|exists:cotisations,id',
        'montant' => 'required|numeric|min:0',
        'date_paiement' => 'required|date',
    ]);

    // Récupérer la cotisation et le marchand
    $cotisation = Cotisation::findOrFail($request->cotisation_id);
    $marchant = Marchant::findOrFail($request->marchant_id);

    // Calculer le montant déjà payé et le reste à payer
    $montantDejaPaye = $marchant->paiements()->where('cotisation_id', $cotisation->id)->sum('montant');
    $resteAPayer = $cotisation->montant_total - $montantDejaPaye;

    // Vérifier si le montant saisi dépasse le reste à payer
    if ($request->montant > $resteAPayer) {
        return redirect()->back()->with('error', 'Le montant saisi dépasse le montant restant à payer.');
    }

    // Créer le paiement
    Paiement::create([
        'marchant_id' => $request->marchant_id,
        'cotisation_id' => $request->cotisation_id,
        'montant' => $request->montant,
        'date_paiement' => $request->date_paiement,
    ]);

    // Rediriger avec un message de succès
    return redirect()->back()
                     ->with('success', 'Paiement enregistré avec succès.');
}

    /**
     * Display the specified resource.
     */
    // Afficher les détails d'un paiement
    public function show(Paiement $paiement)
    {
        // Récupérer le paiement spécifique avec ses relations
        $paiement = Paiement::with(['marchant.cotisations', 'cotisation'])
                            ->findOrFail($paiement->id);
    
        // Récupérer le marchand associé au paiement
        $marchant = $paiement->marchant;
    
        // Récupérer les cotisations du marchand
        $cotisations = $marchant->cotisations;
    
        // Calculer les montants pour chaque cotisation
        $cotisations->each(function ($cotisation) use ($marchant) {
            $montantTotal = $cotisation->montant_total;
            $montantDejaPaye = $marchant->paiements
                ->where('cotisation_id', $cotisation->id)
                ->sum('montant');
            $resteAPayer = $montantTotal - $montantDejaPaye;
    
            // Ajouter ces données à l'objet cotisation
            $cotisation->montant_total_a_payer = $montantTotal;
            $cotisation->montant_deja_paye = $montantDejaPaye;
            $cotisation->reste_a_payer = $resteAPayer;
        });
    
        // Passer les données à la vue
        return view('pages.admin.cotisation.paiment.show', compact('paiement', 'marchant', 'cotisations'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    // Afficher le formulaire de modification d'un paiement
    public function edit(Paiement $paiement)
    {
        $marchants = Marchant::all();
        $cotisations = Cotisation::all();
        return view('paiements.edit', compact('paiement', 'marchants', 'cotisations'));
    }


    /**
     * Update the specified resource in storage.
     */
    // Mettre à jour un paiement
    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'marchant_id' => 'required|exists:marchants,id',
            'cotisation_id' => 'required|exists:cotisations,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        $paiement->update($request->all());

        return redirect()->back()->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Supprimer un paiement
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }

    // Calculer le montant total à payer par adhérent pour une cotisation
    public function montantTotalAPayer($marchantId, $cotisationId)
    {
        $marchant = Marchant::findOrFail($marchantId);
        $cotisation = Cotisation::findOrFail($cotisationId);

        $montantTotal = $cotisation->montant_total;
        $montantDejaPaye = $marchant->paiements()->where('cotisation_id', $cotisationId)->sum('montant');
        $resteAPayer = $montantTotal - $montantDejaPaye;

        return response()->json([
            'montant_total' => $montantTotal,
            'montant_deja_paye' => $montantDejaPaye,
            'reste_a_payer' => $resteAPayer,
        ]);
    }
}
