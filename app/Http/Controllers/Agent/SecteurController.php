<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Secteur;
use App\Models\Marchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecteurController extends Controller
{
    public function index()
    {
        $secteurs = Secteur::with('user')->get();

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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Secteur::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'user_id'     => Auth::id(),
        ]);

        return redirect()
            ->route('secteur.index')
            ->with('success', 'Secteur créé avec succès.');
    }

    public function show(Marchant $marchand)
    {
        return view('pages.agent.market.marchant.show', compact('marchand'));
    }

    public function edit(Secteur $secteur)
    {
        $this->authorize('update', $secteur);

        return view('pages.agent.secteur.edit', compact('secteur'));
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
            ->with('success', 'Le secteur a été mis à jour avec succès.');
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
