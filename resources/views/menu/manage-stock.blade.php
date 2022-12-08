<li class="nav-item {{ Route::is('entry.*') || Route::is('sale.*') || Route::is('out.*') || Route::is('info.entry-ach') || Route::is('info.out-ach') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#manageStock">
        <i class="fas fa-pen-alt"></i>
        <p>Manage Stock</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('entry.*') || Route::is('sale.*') || Route::is('out.*') || Route::is('info.entry-ach') || Route::is('info.out-ach') ? 'show' : '' }}" id="manageStock">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('entry.index') || Route::is('entry.history') || Route::is('info.entry-ach') ? 'active' : '' }}">
                <a href="{{ route('entry.index') }}">
                    <span class="sub-item">Entry Unit</span>
                </a>
            </li>
            <li class="{{ Route::is('sale.index') || Route::is('sale.history') ? 'active' : '' }}">
                <a href="{{ route('sale.index') }}">
                    <span class="sub-item">Unit Sales</span>
                </a>
            </li>
            <li class="{{ Route::is('out.index') || Route::is('out.history') || Route::is('info.out-ach') ? 'active' : '' }}">
                <a href="{{ route('out.index') }}">
                    <span class="sub-item">Unit Out</span>
                </a>
            </li>
        </ul>
    </div>
</li>
