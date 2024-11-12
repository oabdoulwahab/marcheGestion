@extends('layout.layout')
@section('content')
    <section class="pcoded-main-container">
        {{-- <div class="pcoded-content">
         
               
        </div> --}}
        <div class="col-xl-12">
            <h2 class="mt-4">Gestion des finances</h2>
            <div class="card">
                <div class="card-header">
                    <!-- Bouton pour ouvrir la fenêtre modale -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">Ajouter un
                        membre</button>
                </div>
            </div>
            <hr>
            {{-- <div class="card-deck">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Résumé des Dépenses</h5>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Liste des Dépenses</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group" id="expense-list">
                                        @foreach($Finance as $expense)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $expense->name }}: {{ $expense->amount }} €
                                                <button class="btn btn-danger btn-sm" onclick="deleteExpense({{ $expense->id }})">Supprimer</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Fenêtre modale pour ajouter un membre -->
        {{-- <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel"
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
                                        <form id="expense-form" action="{{route('finance.store')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="expense-name">Nom de la Dépense</label>
                                                <input type="text" name="name" class="form-control" id="expense-name"
                                                    placeholder="Entrez le nom de la dépense" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="expense-amount">Montant</label>
                                                <input type="number" name="amount" class="form-control" id="expense-amount"
                                                    placeholder="Entrez le montant" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> --}}


        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h1 class="fs-2 fw-bold text-dark">Gestion des Finances</h1>
            </div>
        
            <div class="row row-cols-1 row-cols-lg-2 g-4">
              <!-- Section Financière -->
              <div class="col">
                <div class="bg-white p-4 rounded shadow-sm">
                  <h2 class="fs-5 fw-semibold text-dark mb-3">Section Financière</h2>
                  
                  <!-- Card Component -->
                  <div id="financialData" class="d-flex flex-column gap-3"></div>
                </div>
              </div>
        
              <!-- Section Comptable -->
              <div class="col">
                <div class="bg-white p-4 rounded shadow-sm">
                  <h2 class="fs-5 fw-semibold text-dark mb-3">Section Comptable</h2>
        
                  <div class="d-flex justify-content-between p-3 bg-light rounded mb-3">
                    <div class="d-flex align-items-center gap-3">
                      <span class="bg-purple p-2 rounded-circle text-white"><i class="fas fa-chart-pie"></i></span>
                      <div>
                        <p class="mb-0 text-secondary">Factures en attente</p>
                        <p class="fs-5 fw-semibold">12</p>
                      </div>
                    </div>
                    <button class="btn btn-link text-decoration-none text-primary">Voir détails</button>
                  </div>
        
                  <div class="p-3 bg-light rounded">
                    <h3 class="fs-6 fw-medium text-dark mb-3">Répartition des Dépenses</h3>
                    <div id="expense-breakdown" class="d-flex flex-column gap-2"></div>
                  </div>
                </div>
              </div>
            </div>
        
            <!-- Transactions Récentes -->
            <div class="bg-white p-4 rounded shadow-sm mt-4">
              <h2 class="fs-5 fw-semibold text-dark mb-3">Transactions Récentes</h2>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Type</th>
                      <th>Montant</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody id="transaction-table"></tbody>
                </table>
              </div>
            </div>
          </div>
        
    </section>
@endsection
