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
   document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('myChart').getContext('2d');
        const data = {
            labels: {!! json_encode($dates) !!}, // Remplir avec les dates dynamiques
            datasets: [
                {
                    label: 'Montant Total',
                    data: {!! json_encode($montants) !!}, // Remplir avec les montants dynamiques
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4,
                }
            ]
        };

        const options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Dates'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Montants (Fr CFA)'
                    },
                    beginAtZero: true
                }
            }
        };

        new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    });
</script>
