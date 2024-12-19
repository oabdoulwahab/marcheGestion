<li class="nav-item pcoded-menu-caption">
    <label>Navigation</label>
    
</li>
@if (auth()->user()->role == 'admin')
<li class="nav-item">
    <a href="{{ route('index') }}" class="nav-link">
        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
        <span class="pcoded-mtext">Tableau de bord</span>
    </a>
    </li> 
<li class="nav-item">
    <a href="{{route('personnel.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Gestion du personnel</span></a>
</li>
@endif
<li class="nav-item">
    <a href="{{route('market.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="">Gestion du Marché</span></a>
</li>
<li class="nav-item"><a href="{{route('contrat.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="">Gestion des contrats</span></a></li>
<li class="nav-item"><a href="{{route('secteur.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="">Gestion des secteurs d'activités</span></a></li>
    
@if (auth()->user()->role == 'admin')
<li class="nav-item">
    <a href="{{route('finance.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">Gestion des finances</span></a>
</li>
@endif