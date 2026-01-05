<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function index()
    {
        // Déjà filtré par le marché courant (Global Scope)
        $finances = Finance::latest()->get();

        return view('pages.admin.gesfin.index', compact('finances'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Finance::class);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'nullable|in:revenu,dépense',
            'amount'      => 'required|numeric|min:0',
            'status'      => 'nullable|in:En attente,Complété,Annulé',
        ]);

        Finance::create([
            ...$validated,
            'type'   => $validated['type'] ?? 'dépense',
            'status' => $validated['status'] ?? 'En attente',
            // market_id AUTOMATIQUE
        ]);

        return redirect()
            ->route('finance.index')
            ->with('success', 'Transaction créée avec succès.');
    }

    public function show(Finance $finance)
    {
        $this->authorize('view', $finance);

        return view('pages.admin.gesfin.show', compact('finance'));
    }

    public function edit(Finance $finance)
    {
        $this->authorize('update', $finance);

        return view('pages.admin.gesfin.edit', compact('finance'));
    }

    public function update(Request $request, Finance $finance)
    {
        $this->authorize('update', $finance);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'type'        => 'required|in:revenu,dépense',
            'amount'      => 'required|numeric',
        ]);

        $finance->update($validated);

        return redirect()
            ->route('finance.index')
            ->with('success', 'Transaction mise à jour avec succès.');
    }

    public function destroy(Finance $finance)
    {
        $this->authorize('delete', $finance);

        $finance->delete();

        return redirect()
            ->back()
            ->with('success', 'Supprimé avec succès.');
    }

    public function updateStatus(Finance $finance, string $status)
    {
        $validStatuses = ['En attente', 'Complété', 'Annulé'];

        if (!in_array($status, $validStatuses)) {
            return back()->with('error', 'Statut non valide.');
        }

        $this->authorize('update', $finance);

        $finance->update(['status' => $status]);

        return back()->with('success', "Statut mis à jour à \"$status\".");
    }
}
