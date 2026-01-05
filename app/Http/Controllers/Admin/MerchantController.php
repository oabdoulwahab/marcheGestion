<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:15',
            'secteur_id' => 'required|exists:secteurs,id',
            'espace_id'  => 'nullable|exists:espaces,id',
        ]);

        $marchant = Marchant::create([
            'name'       => $validated['name'],
            'address'    => $validated['address'] ?? null,
            'phone'      => $validated['phone'] ?? null,
            'secteur_id' => $validated['secteur_id'],
            'espace_id'  => $validated['espace_id'] ?? null,
        ]);

        // Marquer l’espace comme occupé si attribué
        if ($marchant->espace_id) {
            $marchant->espace->update(['status' => 'Occupé']);
        }

        return redirect()->back()
            ->with('success', 'Commerçant ajouté avec succès.');
    }

    /**
     * Show merchants by secteur
     */
    public function show($id)
    {
        $secteur = Secteur::with('marchants')->findOrFail($id);

        return view('pages.admin.market.marchant.index', compact('secteur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marchant $marchant)
    {
        $this->authorize('update', $marchant);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:15',
            'espace_id' => 'required|exists:espaces,id',
        ]);

        // Libérer l’ancien espace si changé
        if ($marchant->espace_id && $marchant->espace_id !== $validated['espace_id']) {
            $marchant->espace->update(['status' => 'Disponible']);
        }

        $marchant->update($validated);

        // Marquer le nouvel espace comme occupé
        $marchant->espace->update(['status' => 'Occupé']);

        return redirect()
            ->route('secteur.show', $marchant->secteur_id)
            ->with('success', 'Commerçant mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marchant $marchant)
    {
        $this->authorize('delete', $marchant);

        // Libérer l’espace si existant
        if ($marchant->espace) {
            $marchant->espace->update(['status' => 'Disponible']);
        }

        $marchant->delete();

        return redirect()->back()
            ->with('success', 'Commerçant supprimé avec succès.');
    }
}
