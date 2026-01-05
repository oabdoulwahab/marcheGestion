<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use App\Models\Marchant;
use App\Models\Secteur;
use App\Models\Vendeur;
use App\Models\Acheteur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContratExport;

class ContratController extends Controller
{
    public function index()
    {
        $marketId = auth()->user()->market_id;

        return view('pages.admin.market.contrat.index', [
            'marchants' => Marchant::where('market_id', $marketId)->get(),
            'secteurs'  => Secteur::where('market_id', $marketId)->get(),
            'contrats'  => Contrat::where('market_id', $marketId)->latest()->get(),
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
            'montant'           => 'required|numeric',
        ]);

        $numeroContrat = 'CONTRAT N°' . now()->format('Ymd-His');

        Contrat::create([
            'numero_contrat' => $numeroContrat,
            'contrat_name'   => $validated['contrat_name'],
            'vendeur_id'     => $this->getOrCreateVendeur($validated)?->id,
            'acheteur_id'    => $this->getOrCreateAcheteur($validated)?->id,
            'date_debut'     => $validated['date_debut'],
            'date_fin'       => $validated['date_fin'],
            'montant'        => $validated['montant'],
            'market_id'      => auth()->user()->market_id,
        ]);

        return back()->with('success', "Contrat ajouté avec succès : $numeroContrat");
    }

    public function show($id)
    {
        $contrat = Contrat::with(['vendeur', 'acheteur'])
            ->where('market_id', auth()->user()->market_id)
            ->findOrFail($id);

        return view('pages.admin.market.contrat.show', compact('contrat'));
    }

    public function destroy($id)
    {
        $contrat = Contrat::where('market_id', auth()->user()->market_id)
            ->findOrFail($id);

        $this->authorize('delete', $contrat);

        $contrat->delete();

        return back()->with('success', 'Contrat supprimé avec succès');
    }

    public function exportPDF($id)
    {
        $contrat = Contrat::with(['vendeur', 'acheteur'])
            ->where('market_id', auth()->user()->market_id)
            ->findOrFail($id);

        return Pdf::loadView('exports.contrat', compact('contrat'))
            ->download("contrat_{$contrat->numero_contrat}.pdf");
    }

    public function exportExcel($id)
    {
        $contrat = Contrat::where('market_id', auth()->user()->market_id)
            ->findOrFail($id);

        return Excel::download(
            new ContratExport($contrat),
            "contrat_{$contrat->numero_contrat}.xlsx"
        );
    }

    public function details($id)
    {
        $contrat = Contrat::with(['vendeur', 'acheteur'])
            ->where('market_id', auth()->user()->market_id)
            ->findOrFail($id);

        return view('pages.admin.market.contrat.details', compact('contrat'));
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
