<li class="nav-item {{ Route::is('specification.*') || Route::is('sparepart.*') ? 'show' : '' }}">
    <a data-toggle="collapse" href="#dataWebsite">
        <i class="fas fa-globe"></i>
        <p>Data Website</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('specification.*') || Route::is('sparepart.*') ? 'show' : '' }}" id="dataWebsite">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('sparepart.index') ? 'active' : '' }}">
                <a href="{{ route('sparepart.index') }}">
                    <span class="sub-item">Data Sparepart</span>
                </a>
            </li>
            <li class="{{ Route::is('specification.index') ? 'active' : '' }}">
                <a href="{{ route('specification.index') }}">
                    <span class="sub-item">Data Specification</span>
                </a>
            </li>
        </ul>
    </div>
</li>
