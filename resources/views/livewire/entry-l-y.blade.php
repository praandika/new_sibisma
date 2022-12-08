<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Entry vs Last Year</b></h5>
                    <p class="text-muted">{{ $lastYear }} vs {{ \Carbon\Carbon::parse($today)->format('Y') }}</p>
                </div>
                <h3 class="text-danger fw-bold">{{ $vsLY >= 0 ? '+'.number_format($vsLY,1) : number_format($vsLY,1) }}%</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                    aria-valuenow="{{ $vsLYach }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vsLYach ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('info.entry-ach', 'ly') }}" class="text-danger" id="vsLY" style="text-decoration: none;">Achievement</a></p>
                <p class="text-muted mb-0">{{ number_format($vsLYach,1) }}%</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#vsLY').mouseenter(function(){
        let link = $('#vsLY');
        link.text('Click for detail');
    })

    $('#vsLY').mouseleave(function(){
        let link = $('#vsLY');
        link.text('Achievement');
    })
</script>
@endpush
