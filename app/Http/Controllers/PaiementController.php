<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\Marchant;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $marchants = Marchant::with(['cotisations', 'paiements'])->get();

        $marchants->each(function ($marchant) {
            $marchant->cotisations->each(function ($cotisation) use ($marchant) {
                $montantTotal = $cotisation->montant_total;

                $montantDejaPaye = $marchant->paiements
                    ->where('cotisation_id', $cotisation->id)
                    ->sum('montant');

                $cotisation->montant_total_a_payer = $montantTotal;
                $cotisation->montant_deja_paye     = $montantDejaPaye;
                $cotisation->reste_a_payer         = $montantTotal - $montantDejaPaye;
            });
        });

        $paiements = Paiement::with(['marchant', 'cotisation'])
            ->orderBy('date_paiement', 'desc')
            ->get();

        return view(
            'pages.admin.cotisation.paiment.show',
            compact('paiements', 'marchants')
        );
    }

    public function create()
    {
        $marchants   = Marchant::all();
        $cotisations = Cotisation::all();

        return view(
            'pages.admin.cotisation.paiment.create',
            compact('marchants', 'cotisations')
        );
    }

    public function store(Request $request)
    {
        $this->authorize('create', Paiement::class);

        $validated = $request->validate([
            'marchant_id'   => 'required|exists:marchants,id',
            'cotisation_id' => 'required|exists:cotisations,id',
            'montant'       => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        $cotisation = Cotisation::findOrFail($validated['cotisation_id']);
        $marchant   = Marchant::findOrFail($validated['marchant_id']);

        $montantDejaPaye = $marchant->paiements()
            ->where('cotisation_id', $cotisation->id)
            ->sum('montant');

        $resteAPayer = $cotisation->montant_total - $montantDejaPaye;

        if ($validated['montant'] > $resteAPayer) {
            return back()->with(
                'error',
                'Le montant dépasse le reste à payer.'
            );
        }

        Paiement::create($validated);

        return back()->with(
            'success',
            'Paiement enregistré avec succès.'
        );
    }

    public function show(Paiement $paiement)
    {
        $this->authorize('view', $paiement);

        $paiement->load(['marchant.cotisations', 'cotisation']);

        $marchant   = $paiement->marchant;
        $cotisations = $marchant->cotisations;

        $cotisations->each(function ($cotisation) use ($marchant) {
            $montantTotal = $cotisation->montant_total;

            $montantDejaPaye = $marchant->paiements
                ->where('cotisation_id', $cotisation->id)
                ->sum('montant');

            $cotisation->montant_total_a_payer = $montantTotal;
            $cotisation->montant_deja_paye     = $montantDejaPaye;
            $cotisation->reste_a_payer         = $montantTotal - $montantDejaPaye;
        });

        return view(
            'pages.admin.cotisation.paiment.show',
            compact('paiement', 'marchant', 'cotisations')
        );
    }

    public function edit(Paiement $paiement)
    {
        $this->authorize('update', $paiement);

        $marchants   = Marchant::all();
        $cotisations = Cotisation::all();

        return view(
            'paiements.edit',
            compact('paiement', 'marchants', 'cotisations')
        );
    }

    public function update(Request $request, Paiement $paiement)
    {
        $this->authorize('update', $paiement);

        $validated = $request->validate([
            'marchant_id'   => 'required|exists:marchants,id',
            'cotisation_id' => 'required|exists:cotisations,id',
            'montant'       => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        $paiement->update($validated);

        return back()->with(
            'success',
            'Paiement mis à jour avec succès.'
        );
    }

    public function destroy(Paiement $paiement)
    {
        $this->authorize('delete', $paiement);

        $paiement->delete();

        return redirect()
            ->route('paiements.index')
            ->with('success', 'Paiement supprimé avec succès.');
    }
}
