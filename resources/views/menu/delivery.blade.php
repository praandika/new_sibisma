<li class="nav-item {{ Route::is('sale-delivery.*') || Route::is('branch-delivery.*') ? 'active' : '' }}" @if(Auth::user()->crud == 'simple') hidden @endif>
    <a data-toggle="collapse" href="#delivery">
        <i class="fas fa-shipping-fast"></i>
        <p>Delivery</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('sale-delivery.*') || Route::is('branch-delivery.*') ? 'show' : '' }}" id="delivery">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('sale-delivery.index') || Route::is('sale-delivery.history') || Route::is('sale-delivery.show') || Route::is('sale-delivery.edit') ? 'active' : '' }}">
                <a href="{{ route('sale-delivery.index') }}">
                    <span class="sub-item">Sale Delivery</span>
                </a>
            </li>
            <li class="{{ Route::is('branch-delivery.index') || Route::is('branch-delivery.history') || Route::is('branch-delivery.show') || Route::is('branch-delivery.edit') ? 'active' : '' }}">
                <a href="{{ route('branch-delivery.index') }}">
                    <span class="sub-item">Branch Delivery</span>
                </a>
            </li>
        </ul>
    </div>
</li>
