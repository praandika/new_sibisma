<li class="nav-item {{ Route::is('dashboard') || Route::is('search') || Route::is('info.sale-ach') ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}">
        <i class="far fa-chart-bar"></i>
        <p>Dashboard</p>
    </a>
</li>
