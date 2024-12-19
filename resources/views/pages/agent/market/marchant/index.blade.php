@extends('layout.layout')

@section('title', 'Liste de ' . $secteurs->name)

@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content container-fluid">
        <!-- En-tête principale -->
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h1 class="font-weight-bold text-dark mb-3 mb-md-0">
                    Liste des Marchands - {{ $secteurs->name }}
                </h1>
                <a href="{{ route('market.index') }}" class="btn btn-danger">
                    <i class="feather icon-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>

        <!-- Champ de recherche -->
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un marchand...">
            </div>
        </div>

        <!-- Tableau des marchands -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body table-border-style">
                        <div class="table-responsive" >
                            <table class="table table-hover table-striped" id="marchantTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom et Prénom</th>
                                        <th>Adresse</th>
                                        <th>numéro d'espace</th>
                                        <th>Téléphone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($marchands as $marchant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $marchant->name }}</td>
                                        <td>{{ $marchant->address ?? 'Non renseignée' }}</td>
                                        <td>{{ $marchant->espace->numero_space ?? 'Non renseignée' }}</td>
                                        <td>{{ $marchant->phone ?? 'Non renseigné' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('marchant.show', $marchant->id) }}" 
                                                   class="btn btn-primary btn-sm mr-2" 
                                                   title="Voir">
                                                    <i class="feather icon-eye"></i>
                                                </a>
                                                <a href="{{ route('marchant.edit', $marchant->id) }}" 
                                                   class="btn btn-success btn-sm mr-2" 
                                                   title="Modifier">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                                <form action="{{ route('marchant.destroy', $marchant->id) }}" 
                                                      method="POST" 
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            title="Supprimer" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')">
                                                        <i class="feather icon-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Aucun marchand trouvé.
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

<!-- Script pour le filtre -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#marchantTable tbody tr');
        
        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase();
            let address = row.cells[2].textContent.toLowerCase();
            let phone = row.cells[3].textContent.toLowerCase();
            
            if (name.includes(filter) || address.includes(filter) || phone.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
