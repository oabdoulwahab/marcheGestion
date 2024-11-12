@extends('layout.layout')
@section('content')
<section class="pcoded-main-container"> 
    <div class="pcoded-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Listes des membres</h2>
                    <!-- Bouton pour ouvrir la fenêtre modale -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">Ajouter un membre</button>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOM</th>
                                    <th>Prénom</th>
                                    <th>Status membre</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Exemple de contenu statique pour la table -->
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Membre du bureau</td>
                                    <td>0707102515</td>
                                    <td>
                                        <a href="#" class="btn btn-success" title="Modifier"><i class="feather icon-edit"></i></a>
                                        <a href="#" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2"></i></a>
                                    </td>
                                </tr>
                                <!-- Autres lignes -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fenêtre modale pour ajouter un membre -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Ajouter un membre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="lastName">Nom</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Entrez le nom">
                        </div>
                        <div class="form-group">
                            <label for="firstName">Prénom</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Entrez le prénom">
                        </div>
                        <div class="form-group">
                            <label for="status">Status membre</label>
                            <input type="text" class="form-control" id="status" placeholder="Entrez le statut">
                        </div>
                        <div class="form-group">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Entrez le numéro de téléphone">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection