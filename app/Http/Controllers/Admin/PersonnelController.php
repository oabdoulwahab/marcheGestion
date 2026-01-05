<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = auth()->user()
            ->currentMarket()
            ->users()
            ->get();

        return view('pages.admin.personnel.index', compact('personnels'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'role'  => 'required|string',
        ]);

        // Création utilisateur
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => Hash::make('password'),
        ]);

        // Attacher l’utilisateur au marché courant avec un rôle
        $user->markets()->attach(
            auth()->user()->currentMarket()->id,
            ['market_role' => $validated['role']]
        );

        return redirect()
            ->route('admin.personnel.index')
            ->with('success', 'Utilisateur enregistré avec succès.');
    }

    public function edit(User $personnel)
    {
        $this->authorize('update', $personnel);

        return view('pages.admin.personnel.edit', compact('personnel'));
    }

    public function update(Request $request, User $personnel)
    {
        $this->authorize('update', $personnel);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $personnel->id,
            'phone' => 'nullable|string|max:15',
            'role'  => 'required|string',
        ]);

        $personnel->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        // Mise à jour du rôle dans le marché courant
        $personnel->setMarketRole(
            auth()->user()->currentMarket()->id,
            $validated['role']
        );

        return redirect()
            ->route('admin.personnel.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $personnel)
    {
        $this->authorize('delete', $personnel);

        // Détacher seulement du marché courant
        $personnel->markets()->detach(
            auth()->user()->currentMarket()->id
        );

        return redirect()
            ->back()
            ->with('success', 'Personnel supprimé du marché avec succès.');
    }
}
