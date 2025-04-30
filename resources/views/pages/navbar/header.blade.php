<div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
        <!-- Search Bar -->
        <li class="nav-item">
            <a href="#" class="pop-search"><i class="feather icon-search"></i></a>
            <div class="search-bar">
                <input type="text" class="form-control border-0 shadow-none" placeholder="Rechercher ici">
                <button type="button" class="close" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </li>

        <!-- Mega Menu Dropdown -->
        <li class="nav-item">
            <div class="dropdown mega-menu">
                <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                    Les Secteurs d'activités
                </a>
                <div class="dropdown-menu">
                    <div class="row no-gutters">
                        <div class="col">
                            <h6 class="mega-title">Contrat: Vente-location</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="dropdown-item"><i class="fas fa-circle"></i> Table</a></li>
                                <li><a href="#" class="dropdown-item"><i class="fas fa-circle"></i> Conteneur</a></li>
                                <li><a href="#" class="dropdown-item"><i class="fas fa-circle"></i> Magasin</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <h6 class="mega-title">Secteur d'activités</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="dropdown-item"><i class="feather icon-minus"></i> Divers</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-minus"></i> Autres</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-minus"></i> Vivrier frais</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-minus"></i> Vivrier sec</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-minus"></i> Légumes</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-minus"></i> Fruits</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
      
</li>
    </ul>

    <!-- User Authentication -->
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            {{-- @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
    
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a 
                        id="userDropdown" 
                        class="nav-link dropdown-toggle" 
                        href="#" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false"
                    >
                        
                        <span class="avatar avatar-xxl"><img class="avatar avatar-xl" src="/images/avatar/1.jpg" />{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{route('create')}}">
                                <i class="feather icon-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="email_inbox.html">
                                <i class="feather icon-mail"></i> My Messages
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="auth-signin.html">
                                <i class="feather icon-lock"></i> Lock Screen
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit(); ">
                                <i class="feather icon-log-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @endguest --}}
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit(); ">
                    <i class="feather icon-log-out"></i> Déconnexion
                </a>
            </li>
       
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </ul>
    </div>
    
</div>
