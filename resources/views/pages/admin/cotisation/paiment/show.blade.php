@extends('layout.layout')

@section('title', 'Détails du paiement')

@section('content')
<section class="pcoded-main-container">
    <div class="container mt-5">
        <h1 class="mb-4">Détails du paiement</h1>

        <!-- Informations sur le paiement -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Paiement #{{ $paiement->id }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Marchand :</strong> {{ $paiement->marchant->name }}</p>
                <p><strong>Montant payé :</strong> {{ number_format($paiement->montant, 2) }} €</p>
                <p><strong>Date du paiement :</strong> {{ $paiement->date_paiement }}</p>
            </div>
        </div>

        <!-- Liste des cotisations du marchand -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Cotisations de {{ $marchant->name }}</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cotisation</th>
                            <th>Montant total à payer</th>
                            <th>Montant déjà payé</th>
                            <th>Reste à payer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cotisations as $cotisation)
                            <tr>
                                <td>{{ $cotisation->date_debut }} - {{ $cotisation->date_fin }}</td>
                                <td>{{ number_format($cotisation->montant_total_a_payer, 2) }} €</td>
                                <td>{{ number_format($cotisation->montant_deja_paye, 2) }} €</td>
                                <td>{{ number_format($cotisation->reste_a_payer, 2) }} €</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Aucune cotisation trouvée pour ce marchand.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection