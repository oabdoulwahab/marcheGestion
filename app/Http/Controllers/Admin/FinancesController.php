<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cotisation;
use App\Models\Finance;
use App\Models\Marchant;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Récupérer les 3 dernières cotisations
    $cotisations = Cotisation::withCount('marchants')
        ->latest() // Trier par date de création décroissante
        ->take(3) 
        ->get();

    // Récupérer toutes les finances et marchands (si nécessaire)
    $type = $request->query('type', 'all'); // Par défaut, affiche tout
    $finances = Finance::when($type !== 'all', function ($query) use ($type) {
        $query->where('type', $type);
    })->get();
    $marchands = Marchant::all();

    return view('pages.admin.gesfin.index', compact('finances', 'marchands', 'cotisations','type'));
}

public function indexByType($type)
    {
        $finances = Finance::byType($type)->get();
        return view('pages.admin.gesfin.index', compact('finances'));
    }

    // Afficher un formulaire pour créer une nouvelle dépense
    public function create()
    {
        // Optionnel : retourner une vue pour créer une dépense
    }

    // Stocker une nouvelle dépense
    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'type' => 'nullable|in:Vente,Achat', 
        'amount' => 'required|numeric|min:0',
        'status' => 'nullable|in:En attente,Complété,Annulé', 
    ]);

    // Si le type n'est pas fourni, il prend 'dépense' par défaut
    $type = $request->type ?? 'Vente';

    // Si le statut n'est pas fourni, il prend 'En attente' par défaut
    $status = $request->status ?? 'En attente';

    // Créer une nouvelle transaction avec les valeurs fournies ou par défaut
    Finance::create([
        'name' => $request->name,
        'description' => $request->description,
        'type' => $type,
        'amount' => $request->amount,
        'status' => $status,
    ]);

    // Retourner à la liste avec un message de succès
    return redirect()->route('admin.finance.index')
        ->with('success', 'Transaction créée avec succès.');
}


    // Afficher une dépense spécifique
    public function show($id)
    {
        $finance = Finance::findOrFail($id);
        return view('pages.admin.gesfin.show',compact('finance'));
    }

    // Afficher un formulaire pour éditer une dépense
    public function edit($id)
    {
        // 
        $finance = Finance::findOrFail($id);
        return view('pages.admin.gesfin.edit', compact('finance'));
    }

    // Mettre à jour une dépense
public function update(Request $request, $id)
{
    // Valider les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|in:Vente,Achat',
        'amount' => 'required|numeric',
    ]);
   
    // Mettre à jour la transaction
    $finance = Finance::findOrFail($id);
    $finance->update($request->all());

    // Rediriger avec un message de succès
    return redirect()->route('finance.index')
        ->with('success', 'Transaction mise à jour avec succès.');
}



    // Supprimer une dépense
    public function destroy($id)
    {
        $finance = Finance::findOrFail($id);
        $finance->delete();
    
        return redirect()->back()->with('success', 'Supprimé avec succès'); 
    }

    public function updateStatus($id, $status)
    {
        $finance = Finance::findOrFail($id);
        
        // Validation du statut pour éviter les valeurs inattendues
        if (in_array($status, ['En attente', 'Complété', 'Annulé'])) {
            $finance->status = $status;
            $finance->save();
    
            return back()->with('success', "Le statut a été mis à jour à \"$status\".");
        }
    
        return back()->with('error', "Statut non valide.");
    }
    
   

}
