<?php

namespace App\Http\Controllers;

use App\Models\Marchant;
use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    public function index()
    {
        $cotisations = Cotisation::withCount('marchants')->get();
        $marchands  = Marchant::all();

        return view(
            'pages.admin.cotisation.cotisation.index',
            compact('marchands', 'cotisations')
        );
    }

    public function store(Request $request)
    {
        $this->authorize('create', Cotisation::class);

        $validated = $request->validate([
            'name'          => 'nullable|string|max:255',
            'montant_total' => 'required|numeric|min:0',
            'date_debut'    => 'required|date',
            'date_fin'      => 'required|date|after:date_debut',
        ]);

        Cotisation::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Cotisation créée avec succès.');
    }

    public function show(Cotisation $cotisation)
    {
        $marchants = $cotisation->marchants()->orderBy('name')->paginate(10);

        $marchandsDisponibles = Marchant::whereDoesntHave(
            'cotisations',
            fn ($q) => $q->where('cotisation_id', $cotisation->id)
        )->get();

        return view(
            'pages.admin.cotisation.cotisation.show',
            compact('cotisation', 'marchants', 'marchandsDisponibles')
        );
    }

    public function update(Request $request, Cotisation $cotisation)
    {
        $this->authorize('update', $cotisation);

        $validated = $request->validate([
            'name'          => 'nullable|string|max:255',
            'montant_total' => 'required|numeric|min:0',
            'date_debut'    => 'required|date',
            'date_fin'      => 'required|date|after:date_debut',
        ]);

        $cotisation->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Cotisation mise à jour avec succès.');
    }

    public function destroy(Cotisation $cotisation)
    {
        $this->authorize('delete', $cotisation);

        $cotisation->delete();

        return redirect()
            ->route('cotisations.index')
            ->with('success', 'Cotisation supprimée avec succès.');
    }

    public function addAdherents(Request $request, Cotisation $cotisation)
    {
        $validated = $request->validate([
            'adherents' => 'required|array',
            'adherents.*' => 'exists:marchants,id',
        ]);

        $cotisation->marchants()->syncWithoutDetaching($validated['adherents']);

        return redirect()
            ->back()
            ->with('success', 'Adhérents ajoutés avec succès.');
    }

    public function removeAdherent(Cotisation $cotisation, Marchant $marchant)
    {
        $cotisation->marchants()->detach($marchant->id);

        return redirect()
            ->back()
            ->with('success', 'Adhérent retiré avec succès.');
    }

    public function filterAdherentsByDate(Request $request, Cotisation $cotisation)
    {
        $filter = $request->input('filter', 'all');

        $query = $cotisation->marchants()->with('paiements');

        match ($filter) {
            'year'  => $query->whereHas(
                'paiements',
                fn ($q) => $q->whereYear('date_payment', now()->year)
            ),
            'month' => $query->whereHas(
                'paiements',
                fn ($q) =>
                    $q->whereYear('date_payment', now()->year)
                      ->whereMonth('date_payment', now()->month)
            ),
            'week'  => $query->whereHas(
                'paiements',
                fn ($q) =>
                    $q->whereBetween(
                        'date_payment',
                        [now()->startOfWeek(), now()->endOfWeek()]
                    )
            ),
            'day'   => $query->whereHas(
                'paiements',
                fn ($q) => $q->whereDate('date_payment', now())
            ),
            default => null,
        };

        return response()->json($query->get());
    }
}
