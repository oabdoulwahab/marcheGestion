<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\Marchant;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $marketId = session('current_market_id');
        // Récupérer tous les adhérents avec leurs cotisations et paiements
        $marchants = Marchant::where('market_id', $marketId)->with(['cotisations', 'paiements'])->get();

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
        $marketId = session('current_market_id');
        $marchants = Marchant::where('market_id', $marketId)->get();
        $cotisations = Cotisation::where('market_id', $marketId)->get();

        return view('pages.admin.cotisation.paiment.create', compact('marchants', 'cotisations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Paiement::class);
        // Valider les données du formulaire
        $request->validate([
            'marchant_id' => 'required|exists:marchants,id',
            'cotisation_id' => 'required|exists:cotisations,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'market_id' => 'required',
        ]);

        // Récupérer la cotisation et le marchand
        $cotisation = Cotisation::where('market_id', session('current_market_id'))->findOrFail($request->cotisation_id);
        $marchant = Marchant::where('market_id', session('current_market_id'))->findOrFail($request->marchant_id);

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
            'market_id' => session('current_market_id'),
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
        $marketId = session('current_market_id');
        // Récupérer le paiement spécifique avec ses relations
        $paiement = Paiement::with(['marchant.cotisations', 'cotisation'])
            ->where('market_id', $marketId)
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
        $marketId = session('current_market_id');
        $paiement = Paiement::where('market_id', $marketId)->findOrFail($paiement->id);
        $marchants = Marchant::where('market_id', $marketId)->get();
        $cotisations = Cotisation::where('market_id', $marketId)->get();

        return view('paiements.edit', compact('paiement', 'marchants', 'cotisations'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Mettre à jour un paiement
    public function update(Request $request, Paiement $paiement)
    {
        $this->authorize('update', $paiement);
        // Valider les données du formulaire
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
        $this->authorize('delete', $paiement);
        $paiement->delete();

        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }

    // Calculer le montant total à payer par adhérent pour une cotisation
    public function montantTotalAPayer($marchantId, $cotisationId)
    {
        $marketId = session('current_market_id');
        $marchant = Marchant::where('market_id', $marketId)->findOrFail($marchantId);
        $cotisation = Cotisation::where('market_id', $marketId)->findOrFail($cotisationId);

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
