<!-- Chart's container -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Sales Chart</h5>
            <div class="card-category">{{ $dealerName }}</div>
            <livewire:widget-stock-qty>
        </div>
        <div class="card-body">
            <div id="saleChart" style="height: 300px;"></div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    const chart = new Chartisan({
        el: '#saleChart',
        url: '@chart("sale_chart")',
        hooks: new ChartisanHooks()
            .legend({
                position: 'bottom'
            })
            .datasets(['bar', 'bar', {
                type: 'line',
                fill: false,
            }])
            .tooltip(true)
    });
</script>
@endpush
