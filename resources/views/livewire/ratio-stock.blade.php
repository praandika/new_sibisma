<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Unit @if(Route::is('sale.*')) Sales @elseif(Route::is('entry.*')) Entry @elseif(Route::is('out.*')) Out @else Sales @endif</b></h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($today)->format('l, j F Y') }}</p>
                </div>
                <h3 class="text-info fw-bold">@if(Route::is('sale.*')) {{ $totalSales }} @elseif(Route::is('entry.*')) {{ $totalEntry }} @elseif(Route::is('out.*')) {{ $totalOut }} @else {{ $totalSales }} @endif</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                    aria-valuenow="{{ $ratioPercent }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ratioPercent ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('info.stock-ratio') }}" class="text-info" id="stockRatio" style="text-decoration: none;">Stock Ratio</a></p>
                <p class="text-muted mb-0">{{ $ratio }}</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#stockRatio').mouseenter(function(){
        let link = $('#stockRatio');
        link.text('Click for detail');
    })

    $('#stockRatio').mouseleave(function(){
        let link = $('#stockRatio');
        link.text('Stock Ratio');
    })
</script>
@endpush
