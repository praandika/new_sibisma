<a href="
    @if(Route::is('stock.*'))
        {{ url('report/stock') }}
    @else
        {{ url('report/manpower') }}
    @endif
" class="btn btn-warning btn-round" style="margin-bottom: 20px;"><i class="fas fa-print"></i>&nbsp;&nbsp; <strong>Print</strong> </a>