<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use Illuminate\Http\Request;

class EspaceController extends Controller
{
    public function index()
    {
        $espaces = Espace::all();

        return view('pages.admin.market.espace.espace', compact('espaces'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Espace::class);

        $request->validate([
            'numero_space' => 'required|max:255|unique:espaces,numero_space',
        ]);

        Espace::create([
            'numero_space' => $request->numero_space,
            'status'       => 'Disponible',
        ]);

        return back()->with('success', 'Espace ajouté avec succès.');
    }

    public function update(Request $request, Espace $espace)
    {
        $this->authorize('update', $espace);

        $request->validate([
            'numero_space' => 'required|max:255|unique:espaces,numero_space,' . $espace->id,
        ]);

        $espace->update([
            'numero_space' => $request->numero_space,
        ]);

        return back()->with('success', 'Espace mis à jour avec succès.');
    }

    public function destroy(Espace $espace)
    {
        $this->authorize('delete', $espace);

        $espace->delete();

        return back()->with('success', 'Espace supprimé avec succès.');
    }

    public function details($id)
    {
        $espace = Espace::findOrFail($id);

        return view('pages.admin.market.espace.details', compact('espace'));
    }
}
