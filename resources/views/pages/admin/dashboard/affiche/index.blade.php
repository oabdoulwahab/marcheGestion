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
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4">Performance SEO</h6>
        
                <div class="publications mt-3">
                    <!-- Section Finances -->
                    <h6 class="mt-4 text-primary">Finances</h6>
                    @foreach ($finances as $finance)
                        <div class="d-flex justify-content-between align-items-center p-3 mb-2 rounded shadow-sm 
                            {{ $finance->amount > 0 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                            <span class="indicator fs-4">
                                {{ $finance->amount > 0 ? '⬆️' : '⬇️' }}
                            </span>
                            <div class="ms-2 w-100">
                                <p class="mb-0">
                                    <strong>{{ $finance->name }}</strong>: {{ $finance->description }} 
                                    ({{ $finance->type }}) - {{ $finance->amount }} Fr CFA
                                </p>
                            </div>
                        </div>
                    @endforeach
        
                    <!-- Section Contrats -->
                    <h6 class="mt-4 text-warning">Contrats</h6>
                    @foreach ($contrats as $contrat)
                        <div class="d-flex justify-content-between align-items-center p-3 mb-2 rounded shadow-sm 
                            {{ $contrat->status === 'actif' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                            <span class="indicator fs-4">
                                {{ $contrat->status === 'actif' ? '⬆️' : '⬇️' }}
                            </span>
                            <div class="ms-2 w-100">
                                <p class="mb-0">
                                    <strong>Contrat {{ $contrat->contrat_name }}</strong> ({{ $contrat->numero_contrat }}) 
                                    - Statut : <span class="fw-bold">{{ ucfirst($contrat->status) }}</span>.
                                </p>
                            </div>
                        </div>
                    @endforeach
        
                    <!-- Section Marchands -->
                    <h6 class="mt-4 text-info">Marchands</h6>
                    @foreach ($marchants as $marchant)
                        <div class="d-flex justify-content-between align-items-center p-3 mb-2 rounded shadow-sm bg-info text-white">
                            <span class="indicator fs-4">📈</span>
                            <div class="ms-2 w-100">
                                <p class="mb-0">
                                    <strong>{{ $marchant->name }}</strong> - Secteur : 
                                    <span class="fw-bold">{{ $marchant->secteur->name ?? 'N/A' }}</span>.
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

   
    

  
</div>
