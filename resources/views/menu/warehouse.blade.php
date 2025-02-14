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
            <li class="{{ Route::is('warehousename.index') ? 'active' : '' }}">
                <a href="{{ route('warehousename.index') }}">
                    <span class="sub-item">Warehouse Name</span>
                </a>
            </li>
            <li class="{{ Route::is('warehouse.generate') ? 'active' : '' }}">
                <a href="{{ route('warehouse.generate', auth()->user()->dealer_code) }}">
                    <span class="sub-item">Generate Code</span>
                </a>
            </li>
        </ul>
    </div>
</li>
