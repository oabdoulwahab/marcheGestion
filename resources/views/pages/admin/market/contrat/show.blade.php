@extends('layout.layout')
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
@section('title', '{{ $contrat->numero_contrat }} ')
<a href="{{ route('contrat.export.pdf', $contrat->id) }}" class="btn btn-danger">Exporter en PDF</a>
<a href="{{ route('contrat.export.excel', $contrat->id) }}" class="btn btn-success">Exporter en Excel</a>

        {{-- <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Détails du Contrat</h3>
                </div>
                <div class="card-body">
                    <!-- Informations Générales -->
                    <h5 class="mb-3">Informations Générales</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Numéro de Contrat</th>
                            <td>{{ $contrat->numero_contrat }}</td>
                        </tr>
                        <tr>
                            <th>Nom du Contrat</th>
                            <td>{{ $contrat->contrat_name }}</td>
                        </tr>
                        <tr>
                            <th>Statut</th>
                            <td>
                                <span
                                    class="badge 
                                {{ $contrat->status == 'actif' ? 'badge-success' : ($contrat->status == 'expiré' ? 'badge-danger' : 'badge-warning') }}">
                                    {{ ucfirst($contrat->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    <!-- Parties Concernées -->
                    <h5 class="mt-4 mb-3">Parties Concernées</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Marchand</th>
                            <td>{{ $contrat->marchant->name ?? 'Non spécifié' }}</td>
                        </tr>
                        <tr>
                            <th>Adresse du Marchand</th>
                            <td>{{ $contrat->marchant->address ?? 'Non spécifiée' }}</td>
                        </tr>
                        <tr>
                            <th>Téléphone du Marchand</th>
                            <td>{{ $contrat->marchant->phone ?? 'Non spécifié' }}</td>
                        </tr>
                    </table>

                    <!-- Détails Financiers -->
                    <h5 class="mt-4 mb-3">Détails Financiers</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Montant</th>
                            <td>{{ number_format($contrat->montant, 2, ',', ' ') }} €</td>
                        </tr>
                        <tr>
                            <th>Date de Début</th>
                            <td>{{ $contrat->date_debut }}</td>
                        </tr>
                        <tr>
                            <th>Date de Fin</th>
                            <td>{{ $contrat->date_fin }}</td>
                        </tr>
                    </table>

                    <!-- Actions -->
                    <div class="mt-4">
                        <a href="{{ route('contrat.edit', $contrat->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('contrat.destroy', $contrat->id) }}" method="POST"
                            class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="container my-5">
            <h1 class="text-center mb-4">{{ $contrat->contrat_name }}</h1>
            <h2 class="text-center">Conteneur</h2>
            <hr>
    
            <h3 class="mt-4">I - DÉSIGNATION DES PARTIES</h3>
            <p>Le présent contrat est conclu entre les soussignés :</p>
    
            <div class="row">
                <div class="col-md-6">
                    <h4>« Le Vendeur »</h4>
                    <ul>
                        <li><strong>Nom et prénom du vendeur :</strong> ______________________________</li>
                        <li><strong>Objet :</strong> Conteneur</li>
                        <li><strong>Montant :</strong>{{ $contrat->montant ?? 'Non spécifié' }}</li>
                        <li><strong>Tél :</strong> {{ $contrat->vendeur->phone ?? 'Non spécifié' }}</li>
                        <li><strong>N° du conteneur :</strong> {{ $contrat->numero_contrat }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>« L’Acheteur »</h4>
                    <ul>
                        <li><strong>Nom et prénom de l’acheteur :</strong> ______________________________</li>
                        <li><strong>Tél :</strong> ______________________________</li>
                        <li><strong>Activité exercée :</strong> ______________________________</li>
                    </ul>
                </div>
            </div>
    
            <h3 class="mt-4">Objet du Contrat</h3>
            <p>Le présent contrat a pour objet la vente du conteneur ainsi déterminé :</p>
            <ul>
                <li><strong>Localisation du conteneur :</strong> Secteur occupé dans le marché</li>
            </ul>
    
            <div class="text-end mt-5">
                <p><strong>Fait le :</strong> …………/…………/2024</p>
            </div>
    
            <h3 class="mt-4">Signatures</h3>
            <div class="row">
                <div class="col-md-4 text-center">
                    <p><strong>Vendeur :</strong> ______________________________</p>
                </div>
                <div class="col-md-4 text-center">
                    <p><strong>Témoin :</strong> ______________________________</p>
                </div>
                <div class="col-md-4 text-center">
                    <p><strong>Acheteur :</strong> ______________________________</p>
                </div>
            </div>
        </div>
</section>

@endsection
