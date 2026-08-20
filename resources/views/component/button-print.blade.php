<a href="
    @if(Route::is('stock.onhand'))
        {{ url('report/stock-onhand') }}
    @else
        {{ url('report/manpower') }}
    @endif
" class="btn {{ Route::is('manpower.*') ? 'btn-light' : 'btn-light'}} btn-round" style="margin-bottom: 20px;"><i class="fas fa-print"></i>&nbsp;&nbsp; <strong>{{ Route::is('manpower.*') ? 'Export' : 'Print'}}</strong> </a>