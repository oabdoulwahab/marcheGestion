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
                    <h5 class="card-title mb-3 text-center fw-bold">Bilan financier </h5>

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
                    
                        
                            <div id="power-card-chart1" class="">
                                <canvas id="myChart"></canvas>
                            </div>
                        
                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
              <h6 class="card-title">Performance SEO</h6>
              <div class="publications mt-3">
                <!-- Publications du jour -->
                <h6 class="text-primary">Aujourd'hui</h6>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Finances</span>
                  <p class="mb-0">{{ $financesToday }} nouvelles publications</p>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Contrats</span>
                  <p class="mb-0">{{ $contratsToday }} nouveaux contrats</p>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Marchands</span>
                  <p class="mb-0">{{ $marchantsToday }} nouveaux marchands</p>
                </div>
          
                <!-- Publications de la semaine -->
                <h6 class="text-success mt-4">Cette semaine</h6>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Finances</span>
                  <p class="mb-0">{{ $financesWeek }} nouvelles publications</p>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Contrats</span>
                  <p class="mb-0">{{ $contratsWeek }} nouveaux contrats</p>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Marchands</span>
                  <p class="mb-0">{{ $marchantsWeek }} nouveaux marchands</p>
                </div>
          
                <!-- Publications du mois -->
                <h6 class="text-warning mt-4">Ce mois</h6>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Finances</span>
                  <p class="mb-0">{{ $financesMonth }} nouvelles publications</p>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Contrats</span>
                  <p class="mb-0">{{ $contratsMonth }} nouveaux contrats</p>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                  <span class="indicator">Marchands</span>
                  <p class="mb-0">{{ $marchantsMonth }} nouveaux marchands</p>
                </div>
              </div>
            </div>
          </div>
          
    </div>

   
    

  
</div>
