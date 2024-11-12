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
                                @forelse ($personnels as $personnel)
                                <tr>
                                    
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$personnel->nom}}</td>
                                    <td>{{$personnel->prenom}}</td>
                                    <td>{{$personnel->poste}}</td>
                                    <td>{{$personnel->contact}}</td>
                                    <td>
                                        <a href="#" class="btn btn-success" title="Modifier"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('personnel.destroy', $personnel->id) }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce personnel?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        {{-- <a href="#" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2"></i></a> --}}
                                    </td> 
                                </tr>
                                 @endforelse
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
                    <form method="POST" action="{{route('personnel.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="lastName">Nom</label>
                            <input type="text" class="form-control" name="nom" id="lastName" placeholder="Entrez le nom">
                        </div>
                        <div class="form-group">
                            <label for="firstName">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="firstName" placeholder="Entrez le prénom">
                        </div>
                        <div class="form-group">
                            <label for="status">Status membre</label>
                            <input type="text" class="form-control" name="poste" id="status" placeholder="Entrez le statut">
                        </div>
                        <div class="form-group">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="text" class="form-control" name="contact" id="phone" placeholder="Entrez le numéro de téléphone">
                        </div>
                        <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</section>




@endsection