<?php

namespace App\Http\Controllers\Agent;

use App\Models\Contrat;
use App\Models\Secteur;
use App\Models\Vendeur;
use App\Models\Acheteur;
use App\Models\Marchant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\ContratExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //     //
       $marchants = Marchant::all();
        $secteurs = Secteur::all();
         $contrats = Contrat::all();
        return View('pages.agent.market.contrat.index', compact('marchants', 'secteurs', 'contrats'));
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
        // Validation des données
        $validatedData = $request->validate([
            'contrat_name' => 'required|string|max:255',
            'vendeur_name' => 'string|max:255|nullable',
            'vendeur_address' => 'string|max:255|nullable',
            'vendeur_phone' => 'string|max:15|nullable',
            'vendeur_email' => 'string|max:255|nullable',
            'acheteur_name' => 'string|max:255|nullable',
            'acheteur_phone' => 'string|max:15|nullable',
            'acheteur_address' => 'string|max:255|nullable',
            'acheteur_activite' => 'string|max:15|nullable',
            'acheteur_email' => 'string|max:255|nullable',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'montant' => 'required|numeric',
        ]);

        // Génération du numéro de contrat
        $currentDate = now()->format('Ymd');
        $timeStamp = now()->format('His');
        $numeroContrat = 'CONTRAT N°' . $currentDate . '-' . $timeStamp;

        // Gestion du vendeur
        $vendeur = null;
        if (!empty($validatedData['vendeur_name'])) {
            $vendeur = Vendeur::firstOrCreate(
                ['name' => $validatedData['vendeur_name']],
                [
                    'addresse' => $validatedData['vendeur_address'] ?? null,
                    'phone' => $validatedData['vendeur_phone'] ?? null,
                    'email' => $validatedData['vendeur_email'] ?? null,
                ]
            );
        }

        // Gestion de l'acheteur
        $acheteur = null;
        if (!empty($validatedData['acheteur_name'])) {
            $acheteur = Acheteur::firstOrCreate(
                ['name' => $validatedData['acheteur_name']],
                [
                    'addresse' => $validatedData['acheteur_address'] ?? null,
                    'phone' => $validatedData['acheteur_phone'] ?? null,
                    'email' => $validatedData['acheteur_email'] ?? null,
                    'activite' => $validatedData['acheteur_activite'] ?? null,
                ]
            );
        }

        // Création du contrat
        $contrat = new Contrat();
        $contrat->numero_contrat = $numeroContrat;
        $contrat->contrat_name = $validatedData['contrat_name'];
        $contrat->vendeur_id = $vendeur ? $vendeur->id : null;
        $contrat->acheteur_id = $acheteur ? $acheteur->id : null;
        $contrat->date_debut = $validatedData['date_debut'];
        $contrat->date_fin = $validatedData['date_fin'];
        $contrat->montant = $validatedData['montant'];

        // Mise à jour automatique du statut
        // $contrat->updateStatus();

        $contrat->save();

        // Redirection avec un message de succès
        return back()->with('success', 'Contrat ajouté avec succès avec le numéro : ' . $numeroContrat);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contrat = Contrat::with('vendeur')->findOrFail($id);
        return view('pages.agent.market.contrat.show', compact('contrat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();
    }

    public function exportPDF($id)
    {
        $contrat = Contrat::with('vendeur', 'acheteur')->findOrFail($id);

        // Génération du PDF
        $pdf = Pdf::loadView('exports.contrat', compact('contrat'));

        // Téléchargement du fichier PDF
        return $pdf->download('contrat_' . $contrat->numero_contrat . '.pdf');
    }


    public function exportExcel($id)
    {
        $contrat = Contrat::findOrFail($id);

        // return Excel::download(new ContratExport($contrat), 'contrat_' . $contrat->numero_contrat . '.xlsx');
    }

}