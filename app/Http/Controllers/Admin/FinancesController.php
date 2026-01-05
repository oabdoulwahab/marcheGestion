<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cotisation;
use App\Models\Finance;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');

        $cotisations = Cotisation::withCount('marchants')->get();

        $finances = Finance::when($type !== 'all', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->latest()
            ->get();

        return view(
            'pages.admin.gesfin.index',
            compact('finances', 'cotisations', 'type')
        );
    }

    public function store(Request $request)
    {
        $this->authorize('create', Finance::class);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'nullable|in:Vente,Achat',
            'amount'      => 'required|numeric|min:0',
            'status'      => 'nullable|in:En attente,Complété,Annulé',
        ]);

        Finance::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'type'        => $validated['type'] ?? 'Vente',
            'amount'      => $validated['amount'],
            'status'      => $validated['status'] ?? 'En attente',
        ]);

        return redirect()
            ->route('admin.finance.index')
            ->with('success', 'Transaction créée.');
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
            'type'        => 'required|in:Vente,Achat',
            'amount'      => 'required|numeric|min:0',
        ]);

        $finance->update($validated);

        return redirect()
            ->route('finance.index')
            ->with('success', 'Mise à jour réussie.');
    }

    public function destroy(Finance $finance)
    {
        $this->authorize('delete', $finance);

        $finance->delete();

        return back()->with('success', 'Supprimé avec succès.');
    }

    public function updateStatus(Finance $finance, $status)
    {
        $this->authorize('update', $finance);

        $statuses = ['En attente', 'Complété', 'Annulé'];

        if (!in_array($status, $statuses)) {
            return back()->with('error', 'Statut non valide.');
        }

        $finance->update(['status' => $status]);

        return back()->with(
            'success',
            "Statut mis à jour à \"$status\"."
        );
    }
}
