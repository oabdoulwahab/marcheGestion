<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cotisation;
use App\Models\Finance;
use App\Models\Marchant;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function index(Request $request)
    {
        $marketId = session('current_market_id');
        $cotisations = Cotisation::withCount('marchants')
            ->where('market_id', $marketId)
            ->get();
        $type = $request->query('type', 'all');
        $finances = Finance::when($type !== 'all', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->where('market_id', $marketId)
            ->latest()
            ->get();
        
        return view('pages.admin.gesfin.index', compact('finances', 'cotisations', 'type'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Finance::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|in:Vente,Achat',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:En attente,Complété,Annulé',
        ]);

        Finance::create($validated + [
            'type' => $request->type ?? 'Vente',
            'status' => $request->status ?? 'En attente',
        ]);

        return redirect()->route('admin.finance.index')->with('success', 'Transaction créée.');
    }

    public function show($id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.gesfin.show', ['finance' => Finance::where('market_id', $marketId)->findOrFail($id)]);
    }

    public function edit($id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.gesfin.edit', ['finance' => Finance::where('market_id', $marketId)->findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Finance::class);
        Finance::where('market_id', session('current_market_id'))->findOrFail($id)->update($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Vente,Achat',
            'amount' => 'required|numeric',
        ]));

        return redirect()->route('finance.index')->with('success', 'Mise à jour réussie.');
    }

    public function destroy($id)
    {
        $finance = Finance::where('id', $id)->firstOrFail();
        $this->authorize('delete', $finance);
        $finance->delete();
        return redirect()->back()->with('success', 'Supprimé avec succès');
    }

    public function updateStatus($id, $status)
    {
        $statuses = ['En attente', 'Complété', 'Annulé'];
        
        if (!in_array($status, $statuses)) {
            return back()->with('error', 'Statut non valide.');
        }

        Finance::where('market_id', session('current_market_id'))->findOrFail($id)->update(['status' => $status]);
        return back()->with('success', "Statut mis à jour à \"$status\".");
    }
}
