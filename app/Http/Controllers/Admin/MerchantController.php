<?php

namespace App\Http\Controllers\Admin;

use App\Models\Espace;
use App\Models\Marchant;
use App\Models\Secteur;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Marchant::class);
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'secteur_id' => 'required|exists:secteurs,id',
            'espace_id' => 'nullable|exists:espaces,id',
        ]);

        $marchant = Marchant::create($request->all());

        if ($request->filled('espace_id')) {
            Espace::where('id', $request->espace_id)->update(['status' => 'Occupé']);
        }

        return redirect()->back()->with('success', 'Commerçant ajouté avec succès');
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id)
    {
        $marketId = session('current_market_id');
        $secteurs = Secteur::with('marchants')->where('market_id', $marketId)->findOrFail($id);

        return view('pages.admin.market.marchant.index', compact('secteurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $marketId = session('current_market_id');
        $this->authorize('update', Marchant::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'espace_id' => 'required|exists:espaces,id',
        ]);

        $marchant = Marchant::where('id', $id)->where('market_id', $marketId)->firstOrFail();
        $this->authorize('update', $marchant);

        $marchant->update($request->only(['name', 'address', 'phone', 'espace_id']));

        return redirect()->route('secteur.show', $marchant->secteur->id)
            ->with('success', 'Marchand mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marchant $marchant)
    {
        if ($marchant->espace_id) {
            Espace::where('id', $marchant->espace_id)->update(['status' => 'Disponible']);
        }

        $this->authorize('delete', $marchant);
        $marchant->delete();

        return redirect()->back()->with('success', 'Commerçant supprimé avec succès');
    }
}
