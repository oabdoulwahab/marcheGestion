<li class="nav-item pcoded-menu-caption">
    <label>Navigation</label>
    
    
        <div class="main-menu-header">
            <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
            <div class="user-details">
                <span>John Doe</span>
                <div id="more-details">UX Designer<i class="fa fa-chevron-down m-l-5"></i></div>
            </div>
        </div>
        <div class="collapse" id="nav-user-link">
            <ul class="list-unstyled">
                <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                <li class="list-group-item"><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                              document.getElementById('logout-form').submit(); "><i class="feather icon-log-out m-r-5"></i><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form></a></li>
            </ul>
        </div>
    
    
</li>
@if (auth()->user()->role == 'admin')
<li class="nav-item">
    <a href="{{route('index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Tableau de bord</span></a>
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