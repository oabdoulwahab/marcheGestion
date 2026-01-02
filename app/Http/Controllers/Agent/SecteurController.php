<?php

namespace App\Http\Controllers\Agent;

use App\Models\Secteur;
use App\Models\Marchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecteurController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        $secteurs = Secteur::with('user')->where('market_id', $marketId)->get();
        return view('pages.agent.secteur.index', compact('secteurs'));
    }

    public function create()
    {
        return view('pages.agent.secteur.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Secteur::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255|nullable',
        ]);

        Secteur::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'user_id' => Auth::id(),
            'market_id' => session('current_market_id'),
        ]);

        return redirect()->route('secteur.index')->with('success', 'Secteur créé avec succès.');
    }

    public function show(string $id)
    {
        $marketId = session('current_market_id');
        $marchand = Marchant::where('market_id', $marketId)->findOrFail($id);
        return view('pages.agent.market.marchant.show', compact('marchand'));
    }

    public function edit(string $id)
    {
        $marketId = session('current_market_id');
        $secteur = Secteur::where('market_id', $marketId)->findOrFail($id);
        return view('pages.admin.secteur.edit', compact('secteur'));
    }

    public function update(Request $request, string $id)
    {
        $marketId = session('current_market_id');
        $this->authorize('update', Secteur::where('market_id', $marketId)->findOrFail($id));
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Secteur::where('market_id', $marketId)->findOrFail($id)->update($validated);

        return redirect()->route('secteur.index')->with('success', 'Le secteur a été mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $marketId = session('current_market_id');
        $secteur = Secteur::where('market_id', $marketId)->where('id', $id)->firstOrFail();
        $this->authorize('delete', $secteur);
        $secteur->delete();
        return redirect()->back()->with('success', 'Supprimé avec succès');
    }
}
