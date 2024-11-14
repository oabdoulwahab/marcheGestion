@extends('layout.layout')
@section('content')
<section class="pcoded-main-container">
    <div class="col-xl-12">
        <h2 class="mt-4">Gestion des finances</h2>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">Ajouter une dépense</button>
            </div>
        </div>
        <hr>
    </div>
      <!-- Fenêtre modale pour ajouter un membre -->
       <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addMemberModalLabel">Ajouter une Dépense</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="card">
                                  <div class="card-body">
                                      <form action="{{ route('finance.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nom de la transaction</label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" class="form-control" id="description">
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select name="type" class="form-control" id="type">
                                                <option value="revenu">Revenu</option>
                                                <option value="dépense" selected>Dépense</option> <!-- Type par défaut -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Montant</label>
                                            <input type="number" name="amount" class="form-control" id="amount" required>
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
      </div>
    <!-- Statistiques et Transactions Récentes -->
    <div class="container my-5">
        <h1 class="fs-2 fw-bold text-dark">Gestion des Finances</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finances as $finance)
                        <tr>
                            <td>{{ $finance->id }}</td>
                            <td>{{ $finance->name }}</td>
                            <td>{{ $finance->description }}</td>
                            <td>{{ $finance->amount }} €</td>
                            <td>{{ $finance->type }}</td>
                            @php
                            // Définir les actions disponibles en fonction du statut actuel
                            $actions = [
                                'En attente' => [
                                    ['status' => 'Complété', 'label' => 'Compléter', 'class' => 'btn-primary'],
                                    ['status' => 'Annulé', 'label' => 'Annuler', 'class' => 'btn-danger']
                                ],
                                'Complété' => [
                                    ['status' => 'En attente', 'label' => 'En attente', 'class' => 'btn-secondary']
                                ],
                                'Annulé' => [
                                    ['status' => 'En attente', 'label' => 'En attente', 'class' => 'btn-secondary']
                                ]
                            ];
                        @endphp

                        <td>
                            @if ($finance->status === 'En attente')
                                <span class="badge badge-secondary">En attente</span>
                            @elseif ($finance->status === 'Complété')
                                <span class="badge badge-primary">Complété</span>
                            @elseif ($finance->status === 'Annulé')
                                <span class="badge badge-danger">Annulé</span>
                            @endif
                        </td>
                        <td>
                            @foreach ($actions[$finance->status] as $action)
                                <form action="{{ route('finance.updateStatus', ['id' => $finance->id, 'status' => $action['status']]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn {{ $action['class'] }} btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir {{ $action['label'] }} ?')">
                                        <i class="fas fa-trash-alt" title="{{ $action['label'] }} "></i></button>
                                </form>
                            @endforeach



                                <a href="{{ route('finance.edit', $finance->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('finance.destroy', $finance->id) }}" method="POST" style="display:inline;">
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
