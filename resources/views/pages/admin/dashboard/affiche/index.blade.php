<div class="row">
    <!-- Carte : Graphique SEO -->
    
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Performance SEO</h6>
                <div id="seo-chart2" class="chart-container"></div>
            </div>
        </div>
        <!-- Carte : Contrats -->
        
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <!-- Titre principal -->
                    <h5 class="card-title mb-3 text-center fw-bold">Les contrats</h5>

                    <!-- Montant total -->
                    <h2 class="fw-bold text-center">
                        {{ $totalMontant }} <span class="text-muted fs-6">Fr CFA</span>
                    </h2>

                    <!-- Détails des montants -->
                    <div class="row mt-4">
                        <!-- Montant du mois -->
                        <div class="col-6 text-center">
                            <h6 class="fw-bold mb-1">{{ $montantMois }} <span>Fr CFA</span></h6>
                            <p class="text-muted small mb-0">Ce mois</p>
                        </div>

                        <!-- Montant d'aujourd'hui -->
                        <div class="col-6 text-center">
                            <h6 class="fw-bold mb-1">{{ $montantToday }} <span>Fr CFA</span></h6>
                            <p class="text-muted small mb-0">Aujourd'hui</p>
                        </div>
                    </div>

                    <!-- Graphique -->
                    <div class="row mt-4">
                        
                            <div id="power-card-chart1" class="chart-container">
                                <canvas id="myChart"></canvas>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid grey-bg"> 
        <section id="minimal-statistics">
            <div class="row">
                <div class="col-12 mt-3 mb-4 text-center">
                    <h4 class="text-uppercase">Résumé des Activités</h4>
                </div>
            </div>
            <div class="row g-4">
                <!-- Exemple de carte avec QR code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="icon-docs primary mb-3 font-large-2"></i>
                            <div class="text-center flex-grow-1">
                                <h3>{{ $totalContrats }}</h3>
                                <span>Total Contrats</span>
                            </div>
                            <div class="mt-3">
                                <!-- Affichage du QR Code -->
                                {!! QrCode::size(100)->generate(route('contrats.details', ['id' => 1])) !!}
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Répétez pour les autres cartes -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="icon-home primary mb-3 font-large-2"></i>
                            <div class="text-center flex-grow-1">
                                {{-- <h3>{{ $espacesAttribues }}</h3> --}}
                                <span>Espaces Attribués</span>
                            </div>
                            <div class="mt-3">
                                {!! QrCode::size(100)->generate(route('espaces.details', ['id' => 2])) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    

    <!-- Ajout d'autres cartes ou graphiques -->
    <db-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Autres Données</h6>
                <div id="power-card-chart3" class="chart-container"></div>
            </div>
        </div>
    </div>
</div>
