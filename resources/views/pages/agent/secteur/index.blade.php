@extends('layout.layout')

@section('title', 'Gestion Market || Gestion des Secteurs d\'Activité')
@section('content')
<section class="pcoded-main-container">
    <div class="col-xl-12">
        <h2 class="mt-4">Gestion des Secteurs d'Activité</h2>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addSectorModal">Ajouter un secteur</button>
            </div>
        </div>
        <hr>
    </div>

    <!-- Fenêtre modale pour ajouter un secteur -->
    <div class="modal fade" id="addSectorModal" tabindex="-1" role="dialog" aria-labelledby="addSectorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectorModalLabel">Ajouter un Secteur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('secteur.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom du Secteur</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Table des secteurs d'activité -->
    <div class="container my-5">
        <h1 class="fs-2 fw-bold text-dark">Liste des Secteurs</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Créer par</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($secteurs as $secteur)
                        <tr>
                            <td>{{ $secteur->id }}</td>
                            <td>{{ $secteur->name }}</td>
                            <td>{{ $secteur->description }}</td>
                            <td>{{ $secteur->user->name }}</td>
                            <td>
                                <a href="{{ route('secteur.edit', $secteur->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit" title="Modifier"></i>
                                </a>
                                <form action="{{ route('secteur.destroy', $secteur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce secteur ?')">
                                        <i class="fas fa-trash-alt" title="Supprimer"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
