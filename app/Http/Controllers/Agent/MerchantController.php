<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Cotisation;
use App\Models\Espace;
use App\Models\Marchant;
use App\Models\Secteur;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', Marchant::class);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:15',
            'secteur_id' => 'required|exists:secteurs,id',
            'espace_id'  => 'nullable|exists:espaces,id',
        ]);

        $marchant = Marchant::create($validated);

        if (!empty($validated['espace_id'])) {
            Espace::find($validated['espace_id'])
                ?->update(['status' => 'Occupé']);
        }

        return back()->with('success', 'Commerçant ajouté avec succès');
    }

    /**
     * Afficher les marchands d’un secteur
     */
    public function show(string $secteurId)
    {
        $secteur = Secteur::with('marchants')->findOrFail($secteurId);

        return view('pages.agent.market.marchant.index', [
            'secteurs'  => $secteur,
            'marchands' => $secteur->marchants,
        ]);
    }

    public function edit(string $id)
    {
        $marchant = Marchant::findOrFail($id);
        $this->authorize('update', $marchant);

        return view('pages.agent.market.marchant.edit', [
            'marchant' => $marchant,
            'espaces'  => Espace::all(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $marchant = Marchant::findOrFail($id);
        $this->authorize('update', $marchant);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:15',
            'espace_id' => 'nullable|exists:espaces,id',
        ]);

        // Libérer ancien espace
        if ($marchant->espace_id && $marchant->espace_id !== $validated['espace_id']) {
            Espace::find($marchant->espace_id)
                ?->update(['status' => 'Disponible']);
        }

        // Occuper nouvel espace
        if (!empty($validated['espace_id'])) {
            Espace::find($validated['espace_id'])
                ?->update(['status' => 'Occupé']);
        }

        $marchant->update($validated);

        return redirect()
            ->route('secteur.show', $marchant->secteur_id)
            ->with('success', 'Marchand mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $marchant = Marchant::findOrFail($id);
        $this->authorize('delete', $marchant);

        if ($marchant->espace_id) {
            Espace::find($marchant->espace_id)
                ?->update(['status' => 'Disponible']);
        }

        $marchant->delete();

        return back()->with('success', 'Commerçant supprimé avec succès');
    }

    public function showAdherent(string $cotisationId, string $marchantId)
    {
        $cotisation = Cotisation::findOrFail($cotisationId);

        $marchant = Marchant::with([
            'paiements' => fn ($q) => $q->where('cotisation_id', $cotisationId)
        ])->findOrFail($marchantId);

        $montantDejaPaye = $marchant->paiements->sum('montant');

        return view('pages.admin.cotisation.marchant.show', [
            'cotisation'       => $cotisation,
            'marchant'         => $marchant,
            'montantTotal'     => $cotisation->montant_total,
            'montantDejaPaye'  => $montantDejaPaye,
            'resteAPayer'      => $cotisation->montant_total - $montantDejaPaye,
        ]);
    }
}
