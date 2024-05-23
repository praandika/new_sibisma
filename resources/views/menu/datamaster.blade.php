<li class="nav-item {{ Route::is('unit.*') || Route::is('color.*') || Route::is('leasing.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#dataMaster">
        <i class="fas fa-database"></i>
        <p>Data Master</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('unit.*') || Route::is('color.*') || Route::is('leasing.*') ? 'show' : '' }}" id="dataMaster">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('unit.index') ? 'active' : '' }}">
                <a href="{{ route('unit.index') }}">
                    <span class="sub-item">Data Unit</span>
                </a>
            </li>
            <li class="{{ Route::is('color.index') ? 'active' : '' }}">
                <a href="{{ route('color.index') }}">
                    <span class="sub-item">Data Color</span>
                </a>
            </li>
            <li class="{{ Route::is('leasing.index') ? 'active' : '' }}">
                <a href="{{ route('leasing.index') }}">
                    <span class="sub-item">Data Leasing</span>
                </a>
            </li>
            <li class="{{ Route::is('unit.add-all') ? 'active' : '' }}">
                <a href="{{ route('unit.add-all') }}">
                    <span class="sub-item">Add All Unit to Stock</span>
                </a>
            </li>
        </ul>
    </div>
</li>
