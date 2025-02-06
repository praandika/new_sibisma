<li class="nav-item {{ Route::is('warehouse.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#warehouse">
        <i class="fas fa-warehouse"></i>
        <p>Warehouse</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('warehouse.*') ? 'show' : '' }}" id="warehouse">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('warehouse.index') ? 'active' : '' }}">
                <a href="{{ route('warehouse.index') }}">
                    <span class="sub-item">Warehouse Data</span>
                </a>
            </li>
            <li class="{{ Route::is('warehouse.name') ? 'active' : '' }}">
                <a href="{{ route('warehouse.name') }}">
                    <span class="sub-item">Warehouse Name</span>
                </a>
            </li>
        </ul>
    </div>
</li>
