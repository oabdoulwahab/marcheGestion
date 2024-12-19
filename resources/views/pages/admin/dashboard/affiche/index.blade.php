<div class="row">
    {{-- <!-- Carte : Graphique SEO -->
    
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Performance SEO</h6>
                <div id="seo-chart2" class="chart-container"></div>
            </div>
        </div> --}}
          
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

   
    

  
</div>
