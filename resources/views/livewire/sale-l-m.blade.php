<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Sales vs Last Month</b></h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($lastMonthDisplay)->format('M Y') }} vs {{ \Carbon\Carbon::parse($today)->format('M Y') }}</p>
                </div>
                <h3 class="text-success fw-bold">{{ $vsLM >= 0 ? '+'.number_format($vsLM,1) : number_format($vsLM,1) }}%</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                    aria-valuenow="{{ $vsLMach }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vsLMach ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('info.sale-ach', 'lm') }}" class="text-success" id="vsLM" style="text-decoration: none;">Achievement</a></p>
                <p class="text-muted mb-0">{{ number_format($vsLMach,1) }}%</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#vsLM').mouseenter(function(){
        let link = $('#vsLM');
        link.text('Click for detail');
    })

    $('#vsLM').mouseleave(function(){
        let link = $('#vsLM');
        link.text('Achievement');
    })
</script>
@endpush