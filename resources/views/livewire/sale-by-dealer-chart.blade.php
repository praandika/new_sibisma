<!-- Chart's container -->
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Sales By Dealer Chart</h5>
            <div class="card-category">Yamaha Bisma Group</div>
        </div>
        <div class="card-body">
            <div id="saleByDealerChart" style="height: 300px;"></div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    const chartByDealer = new Chartisan({
        el: '#saleByDealerChart',
        url: '@chart("sale_by_dealer_chart")',
        hooks: new ChartisanHooks()
            .legend({
                position: 'bottom'
            })
            .datasets([
                {type: 'line', fill: false},
            ])
            .tooltip(true)
    });
</script>
@endpush

