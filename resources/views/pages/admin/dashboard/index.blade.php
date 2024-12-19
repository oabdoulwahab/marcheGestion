@extends('layout.layout')
@section('content')
@section('title', 'Tableau de bord')
<section class="pcoded-main-container">
    <div class="pcoded-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
          <div class="page-block">
              <div class="row align-items-center">
                  <div class="col-12">
                      <div class="page-header-title">
                          <h5 class="m-b-10 text-center text-md-start">Tableau de bord</h5>
                      </div>
                      <ul class="breadcrumb justify-content-center justify-content-md-start">
                          <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                          <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
          
          <!-- Section Affiche Bord -->
          {{-- <div class="col-12 col-md-6 mb-4">
              @include('pages.admin.dashboard.affiche.bord')
          </div> --}}
          <!-- Section Affiche Index -->
          {{-- <div class="col-12 col-md-6 mb-4"> --}}
              @include('pages.admin.dashboard.affiche.index')
          {{-- </div> --}}

      </div>
      <!-- [ Main Content ] end -->

      {{-- <!-- Chart Section -->
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <canvas id="myChart" style="max-height: 400px;"></canvas>
                  </div>
              </div>
          </div>
      </div> --}}

  </div>
</section>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Récupération des données pour le graphique
        var months = JSON.parse('@json($data->pluck("month"))');
        var totals = JSON.parse('@json($data->pluck("total"))');

        // Initialisation du graphique
        var chartElement = document.getElementById('myChart');
        if (chartElement) {
            var ctx = chartElement.getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months.map(month => `Mois ${month}`),
                    datasets: [{
                        label: 'Montant des contrats (en €)',
                        data: totals,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw} €`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Montant (en €)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Mois'
                            }
                        }
                    }
                }
            });
        } else {
            console.error('Élément graphique introuvable : myChart');
        }
    });
</script>
