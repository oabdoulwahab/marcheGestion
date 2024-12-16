<div class="container-fluid grey-bg">
    <section id="minimal-statistics">
        <div class="row">
            <div class="col-12 mt-3 mb-4 text-center">
                <h4 class="text-uppercase">Résumé des Activités</h4>
            </div>
        </div>
        <div class="row ">
            <!-- Card 1 -->
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-docs primary me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>{{ $totalContrats }}</h3>
                            <span>Total Contrats</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-home primary me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>{{ $espacesAttribues }}</h3>
                            <span>Espaces Attribués</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-users primary me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>{{ $nombreMarchants }}</h3>
                            <span>Marchants</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="icon-pencil primary me-3 font-large-2"></i>
                        <div class="text-end flex-grow-1">
                            <h3>278</h3>
                            <span>Nouveaux Posts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ajout d'une section supplémentaire si nécessaire -->
        <div class="row g-4 mt-4">
            <!-- Exemple d'autres cartes -->
            <div class="col-xl-6 col-md-6 col-sm-12">
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
            <div class="col-xl-6 col-md-6 col-sm-12">
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
        </div>
    </section>
    
</div>
