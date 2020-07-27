<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link">
        <i class="fa big-icon fa-home"></i>
        <span class="mini-dn">Dashboard</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>

@if(Auth::user()->role == "st2or")
    <li class="nav-item">
        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="fa big-icon fa-users"></i>
            <span class="mini-dn">Utilisateurs</span>
            <span class="indicator-right-menu mini-dn">
                <i class="fa indicator-mn fa-angle-left"></i>
            </span>
        </a>
        <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
            <a href="{{ route('administrators') }}" class="dropdown-item">Administrateurs</a>
            <a href="leaders.html" class="dropdown-item">Masters</a>
        </div>
    </li>
@elseif(Auth::user()->role == "admin")
    <li class="nav-item">
        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="fa big-icon fa-users"></i>
            <span class="mini-dn">Utilisateurs</span>
            <span class="indicator-right-menu mini-dn">
                <i class="fa indicator-mn fa-angle-left"></i>
            </span>
        </a>
        <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
            <a href="admins.html" class="dropdown-item">Masters</a>
            <a href="leaders.html" class="dropdown-item">Donateurs</a>
        </div>
    </li>
@elseif(Auth::user()->role == "master")
    <li class="nav-item">
        <a href="{{ route('parrains') }}" class="nav-link dropdown-toggle">
            <i class="fa big-icon fa-users"></i>
            <span class="mini-dn">Espace parrain</span>
            <span class="indicator-right-menu mini-dn">
                <i class="fa indicator-mn fa-angle-left"></i>
            </span>
        </a>
    </li>
@endif

@if(Auth::user()->role == "st2or" || Auth::user()->role == "admin")
<li class="nav-item">
    <a href="{{ route('adhesions') }}" class="nav-link">
        <i class="fa big-icon fa-square"></i>
        <span class="mini-dn">Adhésions</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>
@endif

@if(Auth::user()->role == "st2or")
    <li class="nav-item">
        <a href="{{ route('packs') }}" class="nav-link">
            <i class="fa big-icon fa-rss"></i>
            <span class="mini-dn">Gestion des packs</span>
            <span class="indicator-right-menu mini-dn">
                <i class="fa indicator-mn fa-angle-left"></i>
            </span>
        </a>
    </li>
@endif


@if(Auth::user()->role == "suse" || Auth::user()->role == "master")
    <li class="nav-item">
        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="fa big-icon fa-exchange"></i>
            <span class="mini-dn">Opérations</span>
            <span class="indicator-right-menu mini-dn">
                <i class="fa indicator-mn fa-angle-left"></i>
            </span>
        </a>
        <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
            <a href="dons.html" class="dropdown-item">Gestion des dons</a>
            <a href="rsd.html" class="dropdown-item">Gestion des RSD</a>
        </div>
    </li>
@endif
@if(Auth::user()->role == "st2or")
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fa big-icon fa-wrench"></i>
            <span class="mini-dn">Mise en maintenance</span>
            <span class="indicator-right-menu mini-dn">
                <i class="fa indicator-mn fa-angle-left"></i>
            </span>
        </a>
    </li>
@endif
