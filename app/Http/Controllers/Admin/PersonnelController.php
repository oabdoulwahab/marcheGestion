<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personnels = User::all();
        $roles = User::select('role')->distinct()->get();
        return View('pages.admin.personnel.index',compact('personnels','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'contact' => 'nullable|string|max:15',
        'role' => 'required|string|exists:users,role',
    ]);

    $personnel= User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make('password'), // Mot de passe par défaut
        'phone' => $request->input('contact'),
        'role' => $request->input('role'),
    ]);
    $personnel->save();

    return redirect()->route('personnel.index')->with('success', 'Utilisateur enregistré avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $personnel = User::findOrFail($id);
        $roles = User::select('role')->distinct()->get();
        return view('pages.admin.personnel.edit',compact('personnel','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
      
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'contact' => 'nullable|string|max:15',
                'role' => 'required|string',
            ]);
    
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('contact'),
                'role' => $request->input('role'),
                'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
            ]);
    
            return redirect()->route('personnel.index')->with('success', 'Utilisateur mis à jour avec succès.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          
    $personnel = Personnel::findOrFail($id); // Récupère l'enregistrement ou lance une exception si introuvable
    
    $personnel->delete(); // Supprime l'enregistrement

    return redirect()->back()->with('success', 'Un personnel supprimé avec succès');; 
    }
}
