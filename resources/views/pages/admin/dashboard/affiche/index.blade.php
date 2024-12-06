{{-- <!-- Graphiques -->
<div id="line-chart-1"></div>
<div id="area-chart-1"></div>
<div id="bar-chart-1"></div>
<div id="bar-chart-2"></div>
<div id="pie-chart-1"></div>
<div id="pie-chart-2"></div> --}}

{{-- <!-- Graphiques -->
<div id="support-chart"></div>
<div id="power-card-chart1"></div>
<div id="power-card-chart3"></div>
<div id="seo-chart1"></div>--}}
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12"> 
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <div id="seo-chart2"></div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
{{--<div id="seo-chart2"></div>
<div id="seo-chart3"></div>
 <div id="tot-lead"></div>  --}}
 <div class="row">
  <div class="col-sm-6">
      <div class="card">
          <div class="card-body">
              <h5 class="mb-3">Les contrats</h5>
              <h2>{{ $totalMontant }}<span class="text-muted m-l-5 f-14"> Fr CFA</span></h2>
              <div id="power-card-chart1"></div>
              <div class="row">
                  <div class="col col-auto">
                      <div class="map-area">
                          <h6 class="m-0">{{ $montantMois }} <span> Fr CFA</span></h6>
                          <p class="text-muted m-0">Mois</p>
                      </div>
                  </div>
                  <div class="col col-auto">
                      <div class="map-area">
                          <h6 class="m-0">{{ $montantToday }} <span> Fr CFA</span></h6>
                          <p class="text-muted m-0">Aujourd'hui</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


