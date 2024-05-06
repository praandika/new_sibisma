<li class="nav-item {{ Route::is('idcard.index') || Route::is('idcard.show') || Route::is('idcard.edit') ? 'active' : '' }}">
    <a href="{{ route('idcard.index') }}">
        <i class="fas fa-id-card"></i>
        <p>ID Card</p>
    </a>
</li>