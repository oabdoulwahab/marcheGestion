@extends('layout.layout')
@section('content')
@section('title', 'Le tableau de Bord du marché ')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        
        <div class="col-md-12">
            <div class="card">

            @include('pages.admin.market.dashboard.header')
        </div>
    </div>
</div>

</section>


@endsection
