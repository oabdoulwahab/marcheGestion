@extends('layout.layout')
@section('content')
@section('title', 'Marché et contrat ')
<section class="pcoded-main-container">
    <div class="pcoded-content">
            <div class="col-xl-12">
                <h2 class="mt-4">Gestion des contrats</h2>
            </div>
           
                <div class="col-xl-2">

                <div class="card">
                    {{-- <div class="card-header"> --}}
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addContractModal">Ajouter un contrat</button>
                    {{-- </div> --}}
                </div>
                <hr>
            </div>
            
            <!-- Fenêtre modale pour ajouter un contrat -->
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('contrat.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="contract_name">Nom du contrat</label>
                                                    <input type="text" name="contrat_name" class="form-control" id="contract_name" required>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="client_name">Nom du client</label>
                                                    <select name="marchant_id" id="marchant_id" class="form-control" >
                                                        <option value="" disabled selected>Choisir un marchand</option>
                                                        <option value="" ></option>
                                                        @foreach ($marchants as $marchant)
                                                            <option value="{{ $marchant->id }}">{{ $marchant->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="date_debut">Date de début</label>
                                                    <input type="date" name="date_debut" class="form-control" id="date_debut" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_fin">Date de fin</label>
                                                    <input type="date" name="date_fin" class="form-control" id="date_fin" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Montant</label>
                                                    <input type="number" name="montant" class="form-control" id="amount" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Statut</label>
                                                    <select name="status" class="form-control" id="status">
                                                        <option value="actif">Actif</option>
                                                        <option value="expiré">Expiré</option>
                                                        <option value="en attente">En attente</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Créer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOM</th>
                                    <th>Prénom</th>
                                    <th>Type de contrat</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Achat-table</td>
                                    <td>0707102515</td>
                                    <td>
                                        <a href="" class="btn btn-success" title="Modifier"><i class="feather icon-edit" ></i></a>
                                        <a href="" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2" ></i></a>
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</section>


@endsection