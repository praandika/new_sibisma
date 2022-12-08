<li class="nav-item {{ Route::is('manpower.index') || Route::is('manpower.show') || Route::is('manpower.edit') ? 'active' : '' }}">
    <a href="{{ route('manpower.index') }}">
        <i class="fas fa-users"></i>
        <p>Manpower</p>
    </a>
</li>