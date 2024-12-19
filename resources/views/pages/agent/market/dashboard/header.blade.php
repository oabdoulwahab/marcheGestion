<div class="container-fluid my-5">
    <!-- Section Gestion des Marchés -->
    <div class="card-header bg-light mb-4">
        <h2 class="font-weight-bold text-dark">Gestion des Marchés</h2>
    </div>
    <div class="row">
        @forelse ($secteurs as $secteur)
            <!-- Secteur -->
            {{-- <div class="col-12">
                <h3 class="h5 font-weight-bold text-dark mb-4">{{ $secteur->name }}</h3>
            </div>

            <!-- Marchés -->
            @forelse ($secteur->marchants as $marchand) --}}
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow-sm p-3 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-background mr-3">
                                <i class="fas fa-store fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="h6 font-weight-bold text-dark">{{ $secteur->name }}</h4>
                                <p class="text-muted mb-0">{{ $secteur->marchants_count }} marchands</p>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <button class="btn btn-outline-primary btn-block"><a href="{{ route('marchant.show', $secteur->id) }}" class="btn btn-succes">Voir les détails</a> </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Aucun marchand trouvé pour ce secteur.</p>
                </div>
            @endforelse
        {{-- @endforeach --}}
    </div>

    <!-- Secteurs d'Activité -->
    {{-- <div class="bg-white rounded-lg shadow-sm p-4 mt-5">
        <h2 class="h5 font-weight-bold text-dark mb-3">Secteurs d'Activité</h2>
        <div class="row">
            @forelse ($secteurs as $secteur)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="sector-card border p-3 rounded-lg shadow-sm bg-white d-flex align-items-center">
                        <div class="icon mr-3 text-primary">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                        <div>
                            <a href="#" class="text-decoration-none">
                                <h4 class="font-weight-bold text-dark mb-1">{{ $secteur->name }}</h4>
                            </a>
                            <p class="text-muted small mb-0">{{ $secteur->marchants_count }} marchands</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Aucun secteur trouvé.</p>
                </div>
            @endforelse
        </div>
    </div> --}}

    <!-- Table des pourcentages -->
    <div class="mt-5">
        <h4 class="mb-4">Secteurs et leurs Pourcentages</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Secteur</th>
                        <th>Nombre de Marchants</th>
                        <th>Pourcentage (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSecteurs as $secteur)
                        <tr>
                            <td>
                                <i class="fas fa-chart-pie text-primary mr-2"></i>
                                {{ $secteur['name'] }}
                            </td>
                            <td>{{ $secteur['count'] }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">{{ $secteur['percentage'] }}%</span>
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar bg-primary" 
                                             role="progressbar" 
                                             style="width: {{ $secteur['percentage'] }}%;" 
                                             aria-valuenow="{{ $secteur['percentage'] }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
