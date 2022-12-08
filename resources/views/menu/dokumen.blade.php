<li class="nav-item {{ Route::is('document.index') || Route::is('document.show') || Route::is('document.edit') ? 'active' : '' }}" @if(Auth::user()->crud == 'simple') hidden @endif>
    <a href="{{ route('document.index') }}">
        <i class="fas fa-book"></i>
        <p>Document</p>
    </a>
</li>