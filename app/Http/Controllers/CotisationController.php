<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Marchant;
use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        $cotisations = Cotisation::where('market_id', $marketId)->withCount('marchants')->get();
        $marchands = Marchant::where('market_id', $marketId)->get();
        
        return view('pages.admin.cotisation.cotisation.index', compact('marchands', 'cotisations'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Cotisation::class);
        $request->validate([
            'name' => 'nullable|string|max:255',
            'montant_total' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        Cotisation::create($request->all());

        return redirect()->back()->with('success', 'Cotisation créée avec succès.');
    }

    public function show($id)
    {
        $marketId = session('current_market_id');
        $cotisation = Cotisation::where('market_id', $marketId)->with(['marchants' => fn($q) => $q->orderBy('name')])->findOrFail($id);
        $marchants = $cotisation->marchants()->paginate(10);
        $marchands = Marchant::whereDoesntHave('cotisations', fn($q) => $q->where('cotisation_id', $id))->where('market_id', $marketId)->get();

        return view('pages.admin.cotisation.cotisation.show', compact('cotisation', 'marchands'));
    }

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

    public function destroy(Cotisation $cotisation)
    {
        $this->authorize('delete', $cotisation);
        $cotisation->delete();
        return redirect()->route('cotisations.index')->with('success', 'Cotisation supprimée avec succès.');
    }

    public function addAdherents(Request $request, $id)
    {
        $request->validate(['adherents' => 'required|exists:marchants,id']);
        $marketId = session('current_market_id');
        Cotisation::where('market_id', $marketId)->findOrFail($id)->marchants()->syncWithoutDetaching($request->adherents);

        return redirect()->back()->with('success', 'Adhérents ajoutés avec succès.');
    }

    public function removeAdherent($cotisationId, $marchantId)
    {
        $marketId = session('current_market_id');
        Cotisation::where('market_id', $marketId)->findOrFail($cotisationId)->marchants()->detach($marchantId);
        return redirect()->back()->with('success', 'Adhérent retiré avec succès.');
    }

    public function filterAdherentsByDate(Request $request, $cotisationId)
    {
        $marketId = session('current_market_id');
        $filter = $request->input('filter', 'all');
        $query = Cotisation::where('market_id', $marketId)->findOrFail($cotisationId)->marchants()->with('paiements');

        match($filter) {
            'year' => $query->whereHas('paiements', fn($q) => $q->whereYear('date_payment', now()->year)),
            'month' => $query->whereHas('paiements', fn($q) => $q->whereYear('date_payment', now()->year)->whereMonth('date_payment', now()->month)),
            'week' => $query->whereHas('paiements', fn($q) => $q->whereBetween('date_payment', [now()->startOfWeek(), now()->endOfWeek()])),
            'day' => $query->whereHas('paiements', fn($q) => $q->whereDate('date_payment', now())),
            default => $query
        };

        return response()->json($query->get());
    }
}
