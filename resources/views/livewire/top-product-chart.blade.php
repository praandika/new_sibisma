<!-- Chart's container -->
<div class="col-sm-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Top Selling</h5>
                    <div class="card-category">{{ $dealerName }}</div>
                </div>
                <div class="col-md-6">
                    <div class="card-title" style="text-align: right; cursor: pointer; color: #ffffff;"
                            data-toggle="modal" data-target=".modalTopSelling">
                    </div>
                </div>
            </div>
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


