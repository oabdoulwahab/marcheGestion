<?php

namespace App\Http\Controllers\Agent;

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
        $marketId = session('current_market_id');
        return view('pages.agent.market.contrat.index', [
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
            'vendeur_name' => 'nullable|string|max:255',
            'vendeur_address' => 'nullable|string|max:255',
            'vendeur_phone' => 'nullable|string|max:15',
            'vendeur_email' => 'nullable|email|max:255',
            'acheteur_name' => 'nullable|string|max:255',
            'acheteur_phone' => 'nullable|string|max:15',
            'acheteur_address' => 'nullable|string|max:255',
            'acheteur_activite' => 'nullable|string|max:15',
            'acheteur_email' => 'nullable|email|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'montant' => 'required|numeric|min:0',
        ]);

        $contrat = Contrat::create([
            'numero_contrat' => $this->generateNumeroContrat(),
            'contrat_name' => $validated['contrat_name'],
            'vendeur_id' => $this->getOrCreateVendeur($validated)?->id,
            'acheteur_id' => $this->getOrCreateAcheteur($validated)?->id,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'montant' => $validated['montant'],
            'market_id' => session('current_market_id'),
        ]);

        return back()->with('success', "Contrat ajouté : {$contrat->numero_contrat}");
    }

    public function show($id)
    {
        $marketId = session('current_market_id');
        $contrat = Contrat::with('vendeur', 'acheteur')->where('market_id', $marketId)->findOrFail($id);

        return view('pages.agent.market.contrat.show', compact('contrat'));
    }

    public function destroy($id)
    {
        $marketId = session('current_market_id');
        $contrat = Contrat::where('market_id', $marketId)->where('id', $id)->firstOrFail();

        $this->authorize('delete', $contrat);

        $contrat->delete();

        return back()->with('success', 'Contrat supprimé');
    }

    public function exportPDF($id)
    {
        $marketId = session('current_market_id');
        $contrat = Contrat::with('vendeur', 'acheteur')->where('market_id', $marketId)->findOrFail($id);

        return Pdf::loadView('exports.contrat', compact('contrat'))
            ->download("contrat_{$contrat->numero_contrat}.pdf");
    }

    private function generateNumeroContrat()
    {
        return 'CONTRAT N°'.now()->format('YmdHis');
    }

    private function getOrCreateVendeur(array $data)
    {
        return empty($data['vendeur_name']) ? null : Vendeur::firstOrCreate(
            ['name' => $data['vendeur_name']],
            [
                'addresse' => $data['vendeur_address'] ?? null,
                'phone' => $data['vendeur_phone'] ?? null,
                'email' => $data['vendeur_email'] ?? null,
            ]
        );
    }

    private function getOrCreateAcheteur(array $data)
    {
        return empty($data['acheteur_name']) ? null : Acheteur::firstOrCreate(
            ['name' => $data['acheteur_name']],
            [
                'addresse' => $data['acheteur_address'] ?? null,
                'phone' => $data['acheteur_phone'] ?? null,
                'email' => $data['acheteur_email'] ?? null,
                'activite' => $data['acheteur_activite'] ?? null,
            ]
        );
    }
}
