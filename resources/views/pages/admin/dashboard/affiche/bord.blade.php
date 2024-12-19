<div class="container-fluid grey-bg">
    <section id="minimal-statistics">
        <div class="row">
            <div class="col-12 mt-3 mb-4 text-center">
                <h4 class="text-uppercase">Résumé des Activités</h4>
            </div>
        </div>

        <!-- Première ligne de cartes -->
        <div class="row g-4">
            <!-- Card 1 : Total Contrats -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-docs primary me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>{{ $totalContrats }}</h3>
                            <span>Total Contrats</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" 
                                 role="progressbar" 
                                 style="width: {{ $contrat['percentage'] }}%;" 
                                 aria-valuenow="{{ $contrat['percentage'] }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 : Marchands par Secteur -->
            @foreach ($secteurs as $secteur)
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="icon-home primary me-3 font-large-2"></i>
                            <div class="text-end flex-grow-1">
                                <h3>{{ $secteur->marchants_count }}</h3>
                                <span>Marchands de {{$secteur->name}}</span>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 8px;">
                            <div class="progress-bar bg-primary" 
                                 role="progressbar" 
                                 style="width: {{ $secteurpercent['percentage'] }}%;" 
                                 aria-valuenow="{{ $secteurpercent['percentage'] }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Deuxième ligne de cartes -->
        <div class="row g-4 mt-4">
            <!-- Card 3 : Nombre de Marchants -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-users primary me-3 font-large-2"></i>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-end">
                                    <h3>{{ $nombreMarchants }}</h3>
                                    <span>Marchands</span>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height: 8px;">
                                <div class="progress-bar bg-primary" 
                                     role="progressbar" 
                                     style="width: {{ $Marchant['percentage'] }}%;" 
                                     aria-valuenow="{{ $Marchant['percentage'] }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 : Nouveaux Posts -->
            {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-pencil primary me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>278</h3>
                            <span>Nouveaux Posts</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Troisième ligne de cartes (exemple supplémentaire) -->
        {{-- <div class="row g-4 mt-4">
            <!-- Card 5 : Nouveaux Commentaires -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-speech warning me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>156</h3>
                            <span>Nouveaux Commentaires</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 6 : Taux de Rebonds -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-graph success me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>64.89%</h3>
                            <span>Taux de Rebonds</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
</div>
