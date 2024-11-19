<li class="nav-item {{ Route::is('allocation.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#allocation">
        <i class="fas fa-truck-loading"></i>
        <p>Allocation</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('allocation.*') ? 'show' : '' }}" id="allocation">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('allocation.index') ? 'active' : '' }}">
                <a href="{{ route('allocation.index') }}">
                    <span class="sub-item">Allocation In</span>
                </a>
            </li>
            <li class="{{ Route::is('allocation.out') ? 'active' : '' }}">
                <a href="{{ route('allocation.out') }}">
                    <span class="sub-item">Allocation Out</span>
                </a>
            </li>
            <li class="{{ Route::is('allocation.report') ? 'active' : '' }}">
                <a href="{{ route('allocation.report') }}">
                    <span class="sub-item">Allocation Report</span>
                </a>
            </li>
        </ul>
    </div>
</li>
