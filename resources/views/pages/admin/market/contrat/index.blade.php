@extends('layout.layout')
@section('content')
@section('title', 'Marché et contrat ')

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- Votre code HTML ici -->
        <div class="col-xl-2">
            <div class="card">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addContractModal">Ajouter un contrat</button>
            </div>
        </div>

        <!-- Modal de création de contrat -->
        <div class="modal fade" id="addContractModal" tabindex="-1" role="dialog" aria-labelledby="addContractModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addContractModalLabel">Ajouter un contrat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contrat.store') }}" method="POST">
                            @csrf
                        
                            <div class="form-group">
                                <label for="contrat_name">Nom du contrat</label>
                                <input type="text" name="contrat_name" id="contrat_name" class="form-control" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="vendeur_name">Nom du vendeur</label>
                                <input type="text" name="vendeur_name" id="vendeur_name" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                            <div class="form-group">
                                <label for="vendeur_address">Adresse du vendeur</label>
                                <input type="text" name="vendeur_address" id="vendeur_address" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                            <div class="form-group">
                                <label for="vendeur_phone">Téléphone du vendeur</label>
                                <input type="text" name="vendeur_phone" id="vendeur_phone" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                        
                            <div class="form-group">
                                <label for="acheteur_name">Nom de l'acheteur</label>
                                <input type="text" name="acheteur_name" id="acheteur_name" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                            <div class="form-group">
                                <label for="acheteur_phone">Téléphone de l'acheteur</label>
                                <input type="text" name="acheteur_phone" id="acheteur_phone" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                            <div class="form-group">
                                <label for="acheteur_address">Adresse de l'acheteur</label>
                                <input type="text" name="acheteur_address" id="acheteur_address" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                            <div class="form-group">
                                <label for="acheteur_activite">Activité de l'acheteur</label>
                                <input type="text" name="acheteur_activite" id="acheteur_activite" class="form-control">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        
                        
                            <div class="form-group">
                                <label for="date_debut">Date de début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="montant">Montant</label>
                                <input type="number" name="montant" id="montant" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter le contrat</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des contrats -->
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOM</th>
                            <th>Numéro de contrat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrats as $contrat)
                            <tr>
                                <td>1</td>
                                <td>{{ $contrat->contrat_name }}</td>
                                <td>{{ $contrat->numero_contrat }}</td>
                                <td>{{ $contrat->status }}</td>
                                <td>
                                    <a href="{{ route('contrat.show', $contrat->id) }}" class="btn btn-primary" title="Voir">
                                        <i class="feather icon-eye"></i>
                                    </a>
                                   
                                    <form action="{{ route('contrat.destroy', $contrat->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')">
                                            <i class="feather icon-trash-2"></i>
                                        </button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
