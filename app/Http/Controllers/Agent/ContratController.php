<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Acheteur;
use App\Models\Contrat;
use App\Models\Marchant;
use App\Models\Secteur;
use App\Models\Vendeur;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function index()
    {
        return view('pages.agent.market.contrat.index', [
            'marchants' => Marchant::all(),
            'secteurs'  => Secteur::all(),
            'contrats'  => Contrat::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Contrat::class);

        $validated = $request->validate([
            'contrat_name'      => 'required|string|max:255',
            'vendeur_name'      => 'nullable|string|max:255',
            'vendeur_address'   => 'nullable|string|max:255',
            'vendeur_phone'     => 'nullable|string|max:15',
            'vendeur_email'     => 'nullable|email|max:255',
            'acheteur_name'     => 'nullable|string|max:255',
            'acheteur_phone'    => 'nullable|string|max:15',
            'acheteur_address'  => 'nullable|string|max:255',
            'acheteur_activite' => 'nullable|string|max:15',
            'acheteur_email'    => 'nullable|email|max:255',
            'date_debut'        => 'required|date',
            'date_fin'          => 'required|date|after_or_equal:date_debut',
            'montant'           => 'required|numeric|min:0',
        ]);

        $contrat = Contrat::create([
            'numero_contrat' => $this->generateNumeroContrat(),
            'contrat_name'   => $validated['contrat_name'],
            'vendeur_id'     => $this->getOrCreateVendeur($validated)?->id,
            'acheteur_id'    => $this->getOrCreateAcheteur($validated)?->id,
            'date_debut'     => $validated['date_debut'],
            'date_fin'       => $validated['date_fin'],
            'montant'        => $validated['montant'],
            // market_id AUTOMATIQUE
        ]);

        return back()->with(
            'success',
            "Contrat ajouté : {$contrat->numero_contrat}"
        );
    }

    public function show(Contrat $contrat)
    {
        $contrat->load('vendeur', 'acheteur');

        return view('pages.agent.market.contrat.show', compact('contrat'));
    }

    public function destroy(Contrat $contrat)
    {
        $this->authorize('delete', $contrat);

        $contrat->delete();

        return back()->with('success', 'Contrat supprimé');
    }

    public function exportPDF(Contrat $contrat)
    {
        $contrat->load('vendeur', 'acheteur');

        return Pdf::loadView('exports.contrat', compact('contrat'))
            ->download("contrat_{$contrat->numero_contrat}.pdf");
    }

    private function generateNumeroContrat(): string
    {
        return 'CONTRAT N°' . now()->format('YmdHis');
    }

    private function getOrCreateVendeur(array $data)
    {
        if (empty($data['vendeur_name'])) {
            return null;
        }

        return Vendeur::firstOrCreate(
            ['name' => $data['vendeur_name']],
            [
                'addresse' => $data['vendeur_address'] ?? null,
                'phone'    => $data['vendeur_phone'] ?? null,
                'email'    => $data['vendeur_email'] ?? null,
            ]
        );
    }

    private function getOrCreateAcheteur(array $data)
    {
        if (empty($data['acheteur_name'])) {
            return null;
        }

        return Acheteur::firstOrCreate(
            ['name' => $data['acheteur_name']],
            [
                'addresse' => $data['acheteur_address'] ?? null,
                'phone'    => $data['acheteur_phone'] ?? null,
                'email'    => $data['acheteur_email'] ?? null,
                'activite' => $data['acheteur_activite'] ?? null,
            ]
        );
    }
}
