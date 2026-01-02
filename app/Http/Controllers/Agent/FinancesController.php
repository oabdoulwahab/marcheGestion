<?php

namespace App\Http\Controllers\Agent;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        return view('pages.admin.gesfin.index', [
            'finances' => Finance::where('market_id', $marketId)->get()
        ]);
    }

    public function create()
    {
        // Retourner la vue de création si nécessaire
    }

    public function store(Request $request)
    {
        $this->authorize('create', Finance::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|in:revenu,dépense',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:En attente,Complété,Annulé',
        ]);

        Finance::create([
            ...$validated,
            'type' => $validated['type'] ?? 'dépense',
            'status' => $validated['status'] ?? 'En attente',
            'market_id' => session('current_market_id'),
        ]);

        return redirect()->route('finance.index')
            ->with('success', 'Transaction créée avec succès.');
    }

    public function show($id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.gesfin.show', [
            'finance' => Finance::where('market_id', $marketId)->findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.gesfin.edit', [
            'finance' => Finance::where('market_id', $marketId)->findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Finance::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:dépense,revenu',
            'amount' => 'required|numeric',
        ]);

        Finance::where('market_id', $marketId)->findOrFail($id)->update($validated);

        return redirect()->route('finance.index')
            ->with('success', 'Transaction mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $finance = Finance::where('market_id', $marketId)->where('id', $id)->firstOrFail();
        $this->authorize('delete', $finance);
        $finance->delete();

        return redirect()->back()->with('success', 'Supprimé avec succès');
    }

    public function updateStatus($id, $status)
    {
        $validStatuses = ['En attente', 'Complété', 'Annulé'];

        if (!in_array($status, $validStatuses)) {
            return back()->with('error', 'Statut non valide.');
        }

        Finance::where('market_id', $marketId)->findOrFail($id)->update(['status' => $status]);

        return back()->with('success', "Le statut a été mis à jour à \"$status\".");
    }
}
