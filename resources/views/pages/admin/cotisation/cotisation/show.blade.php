@extends('layout.layout')

@section('title', 'Gestion Market || Modifier')

@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content container-fluid">
            <!-- En-tête principale -->
            <!-- Bouton pour ouvrir le modal -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#addAdherentModal">
                Ajouter des adhérents
            </button>

            @include('pages.admin.cotisation.cotisation.create')

            <div class="row mb-4">
                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <h3 class="font-weight-bold text-dark mb-3 mb-md-0">
                        {{ $cotisation->name }}
                    </h3>
                    <a href="{{ route('admin.finance.index') }}" class="btn btn-danger">
                        <i class="feather icon-arrow-left mr-2"></i> Retour
                    </a>
                </div>
            </div>

            <!-- Champ de recherche -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un adhérent...">
                </div>
            </div>

            <!-- Boutons de filtrage par statut de paiement -->
            <div class="row mb-3">
                <div class="col-12">
                    <button onclick="filterAdherents('all')" class="btn btn-outline-secondary filter-button active">
                        Tous
                    </button>
                    <button onclick="filterAdherents('complete')" class="btn btn-outline-secondary filter-button">
                        Paiement complet
                    </button>
                    <button onclick="filterAdherents('incomplete')" class="btn btn-outline-secondary filter-button">
                        Paiement non complet
                    </button>
                </div>
            </div>

            <!-- Tableau des adhérents -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="marchantTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom et Prénom</th>
                                            <th>Montant total à payer</th>
                                            <th>Montant déjà payé</th>
                                            <th>Reste à payer</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cotisation->marchants as $marchant)
                                            <tr data-payment-status="{{ $marchant->montant_deja_paye >= $marchant->montant_total_a_payer ? 'complete' : 'incomplete' }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $marchant->name }}</td>
                                                <td>{{ number_format($marchant->montant_total_a_payer) }} Fr CFA</td>
                                                <td class="{{ $marchant->montant_deja_paye >= $marchant->montant_total_a_payer ? 'text-success' : '' }}">
                                                    {{ number_format($marchant->montant_deja_paye) }} Fr CFA
                                                </td>
                                                <td class="{{ $marchant->montant_deja_paye >= $marchant->montant_total_a_payer ? 'text-danger' : '' }}">
                                                    {{ number_format($marchant->reste_a_payer) }} Fr CFA
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('cotisation.marchant.show', ['cotisationId' => $cotisation->id, 'marchantId' => $marchant->id]) }}"
                                                            class="btn btn-primary btn-sm mr-2" title="Voir">
                                                            <i class="feather icon-eye"></i>
                                                        </a>
                                                        @if ($marchant->montant_deja_paye < $marchant->montant_total_a_payer)
                                                            <a href="#" class="btn btn-success btn-sm mr-2"
                                                                data-toggle="modal"
                                                                data-target="#addPaiementModal{{ $marchant->id }}"
                                                                title="Ajouter un paiement">
                                                                <i class="feather icon-plus"></i> Paiement
                                                            </a>
                                                        @else
                                                            <button class="btn btn-success btn-sm mr-2" disabled
                                                                title="Paiement complet">
                                                                <i class="feather icon-check"></i> Complet
                                                            </button>
                                                        @endif
                                                        @include('pages.admin.cotisation.cotisation.ajout')
                                                        <form
                                                            action="{{ route('cotisation.removeAdherent', ['cotisation' => $cotisation->id, 'marchant' => $marchant->id]) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Supprimer de la cotisation"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir retirer cet adhérent de la cotisation ?')">
                                                                <i class="feather icon-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">
                                                    Aucun adhérent trouvé pour cette cotisation.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection