<?php

namespace App\Http\Controllers\Admin;

use App\Models\Secteur;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecteurController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        $secteurs = Secteur::with('user')->where('market_id', $marketId)->paginate(20);
        return view('pages.admin.secteur.index', compact('secteurs'));
    }

    public function create()
    {
        return view('pages.admin.secteur.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Secteur::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Secteur::create([
            ...$validated,
            'user_id' => Auth::id(),
            'market_id' => session('current_market_id'),
        ]);

        return redirect()->route('secteur.index')->with('success', 'Secteur créé avec succès.');
    }

    public function edit($id)
    {
        $marketId = session('current_market_id');
        $secteur = Secteur::where('market_id', $marketId)->findOrFail($id);
        return view('pages.admin.secteur.edit', compact('secteur'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Secteur::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Secteur::where('market_id', $marketId)->findOrFail($id)->update($validated);
        return redirect()->route('secteur.index')->with('success', 'Secteur mis à jour.');
    }

    public function destroy($id)
    {
        $marketId = session('current_market_id');
        $secteur = Secteur::where('market_id', $marketId)->where('id', $id)->firstOrFail();
        $this->authorize('delete', $secteur);
        $secteur->delete();
        return redirect()->back()->with('success', 'Supprimé avec succès.');
    }
}
