<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecteurController extends Controller
{
    public function index()
    {
        // Filtré automatiquement par le marché courant
        $secteurs = Secteur::with('user')->paginate(20);

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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Secteur::create([
            ...$validated,
            'user_id' => Auth::id(),
            // market_id AUTOMATIQUE via BelongsToMarket
        ]);

        return redirect()
            ->route('secteur.index')
            ->with('success', 'Secteur créé avec succès.');
    }

    public function edit(Secteur $secteur)
    {
        $this->authorize('update', $secteur);

        return view('pages.admin.secteur.edit', compact('secteur'));
    }

    public function update(Request $request, Secteur $secteur)
    {
        $this->authorize('update', $secteur);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $secteur->update($validated);

        return redirect()
            ->route('secteur.index')
            ->with('success', 'Secteur mis à jour.');
    }

    public function destroy(Secteur $secteur)
    {
        $this->authorize('delete', $secteur);

        $secteur->delete();

        return redirect()
            ->back()
            ->with('success', 'Secteur supprimé avec succès.');
    }
}
