<?php

namespace App\Http\Controllers\Admin;


class PersonnelController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        return view('pages.admin.personnel.index', ['personnels' => User::where('market_id', $marketId)->get()]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'contact' => 'nullable|string|max:15',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['contact'],
            'role' => $validated['role'],
            'password' => Hash::make('password'),
            'market_id' => session('current_market_id'),
        ]);

        return redirect()->route('admin.personnel.index')->with('success', 'Utilisateur enregistré avec succès.');
    }

    public function edit(string $id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.personnel.edit', [
            'personnel' => User::where('market_id', $marketId)->findOrFail($id),
            'personnels' => User::where('market_id', $marketId)->get(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $marketId = session('current_market_id');
        $this->authorize('update', User::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'contact' => 'nullable|string|max:15',
            'role' => 'required|string',
        ]);

        User::where('market_id', $marketId)->findOrFail($id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['contact'],
            'role' => $validated['role'],
            'password' => $request->filled('password') ? Hash::make($request->password) : null,
        ]);

        return redirect()->route('admin.personnel.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $marketId = session('current_market_id');
        $personnel = User::where('market_id', $marketId)->findOrFail($id);
        $this->authorize('delete', $personnel);
        $personnel->delete();
        return redirect()->back()->with('success', 'Personnel supprimé avec succès');
    }
}