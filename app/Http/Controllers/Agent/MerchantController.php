<?php

namespace App\Http\Controllers\Agent;

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
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'secteur_id' => 'required|exists:secteurs,id',
            'espace_id' => 'nullable|exists:espaces,id',
        ]);

        Marchant::create($validated);

        if ($request->filled('espace_id')) {
            Espace::find($request->espace_id)?->update(['status' => 'Occupé']);
        }

        return redirect()->back()->with('success', 'Commerçant ajouté avec succès');
    }

    public function show(string $id)
    {
        $secteurs = Secteur::where('market_id', session('current_market_id'))
            ->findOrFail($id);

        return view('pages.agent.market.marchant.index', [
            'secteurs' => $secteurs,
            'marchands' => $secteurs->marchants,
        ]);
    }

    public function edit(string $id)
    {
        $marketId = session('current_market_id');
        $marchant = Marchant::where('market_id', $marketId)
            ->findOrFail($id);

        $this->authorize('update', $marchant);

        return view('pages.agent.market.marchant.edit', [
            'marchant' => $marchant,
            'espaces' => Espace::where('market_id', $marketId)->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $marchant = Marchant::where('market_id', session('current_market_id'))
            ->findOrFail($id);

        $this->authorize('update', $marchant);

        $marchant->update($request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'espace_id' => 'required|exists:espaces,id',
        ]));

        return redirect()->route('secteur.show', $marchant->secteur->id)
            ->with('success', 'Marchand mis à jour avec succès.');
    }

    public function destroy(Marchant $marchant)
    {
        $this->authorize('delete', $marchant);

        if ($marchant->espace_id) {
            Espace::find($marchant->espace_id)?->update(['status' => 'Disponible']);
        }

        $marchant->delete();

        return redirect()->back()->with('success', 'Commerçant supprimé avec succès');
    }

    public function showAdherent($cotisationId, $marchantId)
    {
        $marketId = session('current_market_id');
        
        $cotisation = Cotisation::where('market_id', $marketId)->findOrFail($cotisationId);
        $marchant = Marchant::where('market_id', $marketId)->findOrFail($marchantId)
            ->load(['paiements' => fn($q) => $q->where('cotisation_id', $cotisationId)]);

        $montantDejaPaye = $marchant->paiements->sum('montant');

        return view('pages.admin.cotisation.marchant.show', [
            'cotisation' => $cotisation,
            'marchant' => $marchant,
            'montantTotal' => $cotisation->montant_total,
            'montantDejaPaye' => $montantDejaPaye,
            'resteAPayer' => $cotisation->montant_total - $montantDejaPaye,
        ]);
    }
}
