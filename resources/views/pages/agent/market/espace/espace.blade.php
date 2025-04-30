@extends('layout.layout')

@section('title', 'Gestion des Espaces' )

@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content container-fluid">
            <div class="container">
                <h1>Gestion des Espaces</h1>

                <!-- Affichage des messages -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Liste des espaces -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Numéro d'espace</th>
                            <th>Secteur</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($espaces as $espace)
                            <tr>
                                <td>{{ $espace->numero_space }}</td>
                                <td>{{ $espace->secteur->name ?? 'Non défini' }}</td>
                                <td>{{ $espace->status }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editEspaceModal{{ $espace->id }}">Modifier</button>
                                    <form action="{{ route('espace.destroy', $espace->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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
