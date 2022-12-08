<!-- Chart's container -->
<div class="col-sm-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Top Selling</h5>
            <div class="card-category">{{ $dealerName }}</div>
        </div>
        <div class="card-body">
            <div id="topProductChart" style="height: 300px;"></div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    const chartTopProduct = new Chartisan({
        el: '#topProductChart',
        url: '@chart("top_product_chart")',
        hooks: new ChartisanHooks()
            .legend({
                position: 'bottom'
            })
            .datasets('pie')
            .axis(false)
            .tooltip(true)
    });
</script>
@endpush


