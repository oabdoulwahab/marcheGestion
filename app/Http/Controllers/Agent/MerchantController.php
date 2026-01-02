<?php

namespace App\Http\Controllers\Agent;

use App\Models\Cotisation;
use App\Models\Espace;
use App\Models\Marchant;
use App\Models\Secteur;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $this->authorize('create', Marchant::class);
        // Validation des données
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'secteur_id' => 'required|exists:secteurs,id',
            'espace_id' => 'nullable|exists:espaces,id', // Assurez-vous que l'ID de l'espace existe si fourni
        ]);

        // Créer le commerçant
        $marchant = Marchant::create($request->all());

        // Vérifier si l'ID de l'espace est fourni
        if ($request->filled('espace_id')) {
            // Mise à jour du statut de l'espace
            $espace = Espace::find($request->espace_id);

            if ($espace) {
                $espace->status = 'Occupé'; // Vous pouvez mettre un autre statut comme 'Réservé' si nécessaire
                $espace->save();
            } else {
                return redirect()->back()->with('error', 'Espace non trouvé');
            }
        }

        return redirect()->back()->with('success', 'Commerçant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marketId = session('current_market_id');
        // Récupérer un secteur spécifique avec ses commerçants et leurs espaces
        $secteurs = Secteur::where('market_id', $marketId)->findOrFail($id);
        $marchands = $secteurs->marchants;

        // Retourner la vue avec les données du secteur
        return view('pages.agent.market.marchant.index', compact('secteurs', 'marchands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $marketId = session('current_market_id');
        $marchant = Marchant::where('market_id', $marketId)->where('id', $id)->firstOrFail();
        $this->authorize('update', $marchant);

        $espaces = Espace::where('market_id', $marketId)->get();

        return view('pages.agent.market.marchant.edit', compact('marchant', 'espaces'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'espace_id' => 'required|exists:espaces,id',
        ]);

        $marchant = Marchant::where('market_id', session('current_market_id'))->where('id', $id)->firstOrFail();
        $this->authorize('update', $marchant);

        $marchant->name = $request->input('name');
        $marchant->address = $request->input('address');
        $marchant->phone = $request->input('phone');
        $marchant->espace_id = $request->input('espace_id');
        $marchant->save();

        return redirect()->route('secteur.show', $marchant->secteur->id)
            ->with('success', 'Marchand mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marchant $marchant)
    {
        // Vérifier si le commerçant est associé à un espace
        if ($marchant->espace_id) {
            // Mettre à jour le statut de l'espace associé
            $espace = Espace::find($marchant->espace_id);
            $espace->update(['status' => 'Disponible']);
        }

        // Supprimer le commerçant
        $this->authorize('delete', $marchant);
        $marchant->delete();

        return redirect()->back()->with('success', 'Commerçant supprimé avec succès');
    }

    public function showAdherent($cotisationId, $marchantId)
    {
        // Récupérer la cotisation
        $marketId = session('current_market_id');
        $cotisation = Cotisation::where('market_id', $marketId)->findOrFail($cotisationId);

        // Récupérer l'adhérent avec ses paiements pour cette cotisation
        $marchant = Marchant::$marchant = Marchant::where('market_id', $marketId)
            ->where('id', $marchantId)
            ->with(['paiements' => function ($query) use ($cotisationId) {
                $query->where('cotisation_id', $cotisationId);
            }])
            ->firstOrFail();

        // dd($marchant);
        // Calculer les montants pour l'adhérent
        $montantTotal = $cotisation->montant_total;
        $montantDejaPaye = $marchant->paiements->sum('montant');
        $resteAPayer = $montantTotal - $montantDejaPaye;

        // Passer les données à la vue
        return view('pages.admin.cotisation.marchant.show', compact('cotisation', 'marchant', 'montantTotal', 'montantDejaPaye', 'resteAPayer'));
    }
}
