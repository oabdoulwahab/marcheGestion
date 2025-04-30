@extends('layout.layout')

@section('title', 'Détails de l\'adhérent'. $marchant->name)

@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Détails de l'adhérent : {{ $marchant->name }}</h3>
                        <p>Cotisation : {{ $cotisation->date_debut }} - {{ $cotisation->date_fin }}</p>
                    </div>
                    <div class="card-body">
                        <!-- Informations de l'adhérent -->
                        <div class="mb-4">
                            <h4>Informations personnelles</h4>
                            <p><strong>Nom :</strong> {{ $marchant->name }}</p>
                            <p><strong>Adresse :</strong> {{ $marchant->address }}</p>
                            <p><strong>Téléphone :</strong> {{ $marchant->phone }}</p>
                            <p><strong>Date d'inscription :</strong> {{ $cotisation->marchant-> }}</p>
                        </div>

                        <!-- Montants de la cotisation -->
                        <div class="mb-4">
                            <h4>Montants</h4>
                            <p><strong>Montant total à payer :</strong> {{ number_format($montantTotal, 2) }} Fr CFA</p>
                            <p><strong>Montant déjà payé :</strong> {{ number_format($montantDejaPaye, 2) }} Fr CFA</p>
                            <p><strong>Reste à payer :</strong> {{ number_format($resteAPayer, 2) }} Fr CFA</p>
                        </div>

                        <!-- Liste des paiements -->
                        <div class="mb-4">
                            <h4>Paiements</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Montant</th>
                                        <th>Date du paiement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($marchant->paiements as $paiement)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ number_format($paiement->montant, 2) }} Fr CFA</td>
                                            <td>{{ $paiement->date_paiement }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                Aucun paiement enregistré pour cet adhérent.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Bouton pour ajouter un paiement -->
                        @if($resteAPayer > 0)
                            <a href="#"
                               class="btn btn-success" data-toggle="modal" data-target="#addPaiementModal{{ $marchant->id }}"  title="Ajouter un paiement">
                               <i class="feather icon-plus"></i> Ajouter un paiement
                            </a>
                            
                        @else
                            <button class="btn btn-success" disabled>
                                <i class="feather icon-check"></i> Paiement complet
                            </button>
                        @endif
                    </div>
                    @include('pages.admin.cotisation.cotisation.ajout')

                </div>
            </div>
        </div>
    </div>
</section>
@endsection