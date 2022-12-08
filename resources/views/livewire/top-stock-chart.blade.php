<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Top Stocks</div>
            <div class="card-category">{{ $dealerName }}</div>
        </div>
        <div class="card-body pb-0">
            @forelse($data as $o)
            <div class="d-flex">
                <div class="avatar">
                    <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="flex-1 pt-1 ml-2">
                    <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                    <small class="text-muted">{{ $o->category }}</small>
                </div>
                <div class="d-flex ml-auto align-items-center">
                    <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                </div>
            </div>
            <div class="separator-dashed"></div>
            @empty
            <div class="d-flex">
                <div class="avatar">
                    <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="flex-1 pt-1 ml-2">
                    <h6 class="fw-bold mb-1">Model Name</h6>
                    <small class="text-muted">No Data Available</small>
                </div>
                <div class="d-flex ml-auto align-items-center">
                    <h3 class="text-info fw-bold">0</h3>
                </div>
            </div>
            <div class="separator-dashed"></div>
            @endif
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Top Stocks</div>
            <div class="card-category">{{ $dealerName }}</div>
        </div>
        <div class="card-body pb-0">
            <div class="pull-in">
                <div id="topStockChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    const chartTopStock = new Chartisan({
        el: '#topStockChart',
        url: '@chart("top_stock_chart")',
        hooks: new ChartisanHooks()
            .legend({
                position: 'bottom'
            })
            .datasets('bar')
            .tooltip(true)
    });

</script>
@endpush
