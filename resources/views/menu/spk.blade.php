<li class="nav-item {{ Auth::user()->access == 'salesman' ? 'active' : (Route::is('spk.*') ? 'active' : '') }}" @if(Auth::user()->crud == 'simple') hidden @endif>
    <a href="{{ route('spk.index') }}">
        <i class="fas fa-sticky-note"></i>
        <p>SPK</p>
    </a>
</li>