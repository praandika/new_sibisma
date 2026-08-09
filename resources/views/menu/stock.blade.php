<li class="nav-item {{ Route::is('stock.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#stock">
        <i class="fas fa-motorcycle"></i>
        <p>Stock</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('stock.*') ? 'show' : '' }}" id="stock">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('stock.onhand') ? 'active' : '' }}">
                <a href="{{ route('stock.onhand') }}">
                    <span class="sub-item">On-Hand</span>
                </a>
            </li>
            <li class="{{ Route::is('stock.mutation') ? 'active' : '' }}">
                <a href="{{ route('stock.mutation') }}">
                    <span class="sub-item">Mutation</span>
                </a>
            </li>
            <li class="{{ Route::is('stock.sold') ? 'active' : '' }}">
                <a href="{{ route('stock.sold') }}">
                    <span class="sub-item">Sold</span>
                </a>
            </li>
        </ul>
    </div>
</li>
