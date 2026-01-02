<?php

namespace App\Http\Controllers\Admin;

class ContratController extends Controller
{
    public function index()
    {
        $marketId = session('current_market_id');
        return view('pages.admin.market.contrat.index', [
            'marchants' => Marchant::where('market_id', $marketId)->get(),
            'secteurs' => Secteur::where('market_id', $marketId)->get(),
            'contrats' => Contrat::where('market_id', $marketId)->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Contrat::class);
        $validated = $request->validate([
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

        $numeroContrat = 'CONTRAT N°'.now()->format('Ymd-His');

        Contrat::create([
            'numero_contrat' => $numeroContrat,
            'contrat_name' => $validated['contrat_name'],
            'vendeur_id' => $this->getOrCreateVendeur($validated)->id ?? null,
            'acheteur_id' => $this->getOrCreateAcheteur($validated)->id ?? null,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'montant' => $validated['montant'],
            'market_id' => session('current_market_id'),
        ]);

        return back()->with('success', "Contrat ajouté avec succès : $numeroContrat");
    }

    private function getOrCreateVendeur($data)
    {
        return $data['vendeur_name'] ? Vendeur::firstOrCreate(
            ['name' => $data['vendeur_name']],
            ['addresse' => $data['vendeur_address'] ?? null, 'phone' => $data['vendeur_phone'] ?? null, 'email' => $data['vendeur_email'] ?? null]
        ) : null;
    }

    private function getOrCreateAcheteur($data)
    {
        return $data['acheteur_name'] ? Acheteur::firstOrCreate(
            ['name' => $data['acheteur_name']],
            ['addresse' => $data['acheteur_address'] ?? null, 'phone' => $data['acheteur_phone'] ?? null, 'email' => $data['acheteur_email'] ?? null, 'activite' => $data['acheteur_activite'] ?? null]
        ) : null;
    }

    public function show($id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.market.contrat.show', ['contrat' => Contrat::with('vendeur', 'acheteur')->where('market_id', $marketId)->findOrFail($id)]);
    }

    public function destroy($id)
    {
        $contrat = Contrat::where('id', $id)->firstOrFail();

        $this->authorize('delete', $contrat);

        $contrat->delete();
    }

    public function exportPDF($id)
    {
        $marketId = session('current_market_id');
        $contrat = Contrat::with('vendeur', 'acheteur')->where('market_id', $marketId)->findOrFail($id);

        return Pdf::loadView('exports.contrat', compact('contrat'))->download("contrat_$contrat->numero_contrat.pdf");
    }

    public function exportExcel($id)
    {
        $marketId = session('current_market_id');
        $contrat = Contrat::with('vendeur', 'acheteur')->where('market_id', $marketId)->findOrFail($id);

        return Excel::download(new ContratExport($contrat), "contrat_$contrat->numero_contrat.xlsx");
    }

    public function details($id)
    {
        $marketId = session('current_market_id');
        return view('pages.admin.market.contrat.details', ['contrat' => Contrat::with('vendeur', 'acheteur')->where('market_id', $marketId)->findOrFail($id)]);
    }
}
