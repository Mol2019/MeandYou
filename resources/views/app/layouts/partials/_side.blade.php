 <nav id="sidebar">
    <div class="sidebar-header">
        <a href="#">
            @if(Auth::user()->photo != "")
                <img src="{{asset(Auth::user()->photo)}}" alt="" />
            @else
                <img src="{{asset('assets/images/users-img/default.jpg') }}" alt="" />
            @endif
        </a>
        <h3>{{ Auth::user()->prenoms ." ".Auth::user()->nom }}</h3>
        <p>
            @if(Auth::user()->role == "st2or")
                Super administrateur
            @elseif(Auth::user()->role == "admin"):
                Administrateur
            @elseif(Auth::user()->role == "master") :
                Master
            @else :
                Utilisateur
            @endif

        </p>
        <strong>MYC+</strong>
    </div>
    <div class="left-custom-menu-adp-wrap">
        <ul class="nav navbar-nav left-sidebar-menu-pro">
            @include('app.layouts.partials._menu')
        </ul>
    </div>
</nav>
