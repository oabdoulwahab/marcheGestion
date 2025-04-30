@extends('layout.layout')

@section('title', 'Le tableau de Bord du marché')

@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content container-fluid">
        <!-- Boutons d'action -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-start gap-3">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMarchantModal">
                    <i class="fas fa-plus-circle mr-2"></i> Ajouter un commerçant
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEspaceModal">
                    <i class="fas fa-plus-circle mr-2"></i>Ajouter un espace
                </button>
                
                <a href="#" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-2"></i> Ajouter
                </a>
                
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="row">
            <!-- Inclusion de la section "marchand" -->
            <div class="col-12">
                @include('pages.admin.market.marchant.marchand')
                @include('pages.admin.market.espace.index')
            </div>

            <!-- Dashboard des marchés -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm">
                    <!-- Header du Dashboard -->
                    <div class="card-header bg-light">
                        <h4 class="font-weight-bold text-dark">Dashboard - Aperçu des Marchés</h4>
                    </div>

                    <!-- Contenu du Dashboard -->
                    <div class="card-body">
                        @include('pages.admin.market.dashboard.header')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
