<div class="container my-5">
    <div class="card-header">
        <h2 class="font-weight-bold text-dark mb-4">Gestion des Marchés</h2>
    </div>
    <div class="row">
        <!-- Cartes pour chaque marché -->
        <div id="markets" class="col-12 d-flex flex-wrap">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-background mr-3"><i class="fas fa-store"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold text-dark">Marché Central</h3>
                            <p class="text-muted">Centre-ville</p>
                        </div>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Type</span>
                        <span class="font-weight-medium">Alimentaire</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Status</span>
                        <span class="status-actif">Actif</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Revenue</span>
                        <span class="font-weight-medium">€12,000</span>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-outline-primary btn-block">Voir les détails</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-background mr-3"><i class="fas fa-store"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold text-dark">Marché aux Fleurs</h3>
                            <p class="text-muted">Quartier Sud</p>
                        </div>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Type</span>
                        <span class="font-weight-medium">Floral</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Status</span>
                        <span class="status-actif">Actif</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Revenue</span>
                        <span class="font-weight-medium">€8,500</span>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-outline-primary btn-block">Voir les détails</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-background mr-3"><i class="fas fa-store"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold text-dark">Marché Artisanal</h3>
                            <p class="text-muted">Vieille Ville</p>
                        </div>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Type</span>
                        <span class="font-weight-medium">Artisanat</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Status</span>
                        <span class="status-preparation">En préparation</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Revenue</span>
                        <span class="font-weight-medium">€0</span>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-outline-primary btn-block">Voir les détails</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="bg-white rounded-lg shadow-sm p-4 mt-5">
        <h2 class="h5 font-weight-bold text-dark mb-3">Secteurs d'Activité</h2>
        <div class="row">
            <!-- JavaScript génère les secteurs d'activité -->
            <div id="sectors" class="row col-6 d-flex flex-wrap" data-sectors="{{ $secteurs->toJson() }}">
                @forelse ($secteurs as $secteur)
                <div class="col-md-6 mb-3">
                    <div class="border p-3 rounded-lg d-flex align-items-center">
                        <div class="mr-3"><i class="fas fa-building text-muted"></i></div>
                        <div>
                                <p class="font-weight-bold text-dark mb-2">{{ $secteur->name }}</p>
                                <p class="text-muted small">{{ $secteur->marchants_count }} marchands</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Aucun secteur trouvé.</p>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>Secteurs et Pourcentages</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Secteur</th>
                                <th>Nombre de Marchants</th>
                                <th>Pourcentage (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSecteurs as $secteur)
                                <tr>
                                    <td>{{ $secteur['name'] }}</td>
                                    <td>{{ $secteur['count'] }}</td>
                                    <td>{{ $secteur['percentage'] }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- <div id="sectors" class="col-12 d-flex flex-wrap"></div> --}}
        </div>
    </div>
</div>
