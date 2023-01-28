<div class="col-12 col-sm-6 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>STU vs Real</b></h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($yesterday)->format('d M Y') }}</p>
                </div>
                <h3 class="text-primary fw-bold">{{ $stuReal >= 0 ? '+'.number_format($stuReal,1) : number_format($stuReal,1) }}%</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
                    aria-valuenow="{{ $stuRealAch }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $stuRealAch ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('info.stu-real-ach') }}" class="text-primary" id="stuReal" style="text-decoration: none;">Achievement</a></p>
                <p class="text-muted mb-0">{{ number_format($stuReal,1) }}%</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#stuReal').mouseenter(function(){
        let link = $('#stuReal');
        link.text('Click for detail');
    })

    $('#stuReal').mouseleave(function(){
        let link = $('#stuReal');
        link.text('Achievement');
    })
</script>
@endpush
