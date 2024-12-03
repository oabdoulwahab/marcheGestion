<div class="container my-5">
    
    <div class="card-header">
        <h2 class="font-weight-bold text-dark mb-4">Gestion des Marchés</h2>
    </div>
    <div class="row">
        <!-- JavaScript génère les cartes pour chaque marché -->
        <div id="markets" class="col-12 d-flex flex-wrap"></div>
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
