<!-- Chart's container -->
<div class="col-sm-8">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Purchase Stock Inventory</h5>
            <div class="card-category">{{ $dealerName }}</div>
            <div class="card-category"></div>
        </div>
        <div class="card-body">
            <div id="PsiChart" style="height: 300px;"></div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    const chartPsi = new Chartisan({
        el: '#PsiChart',
        url: '@chart("psi_chart")',
        hooks: new ChartisanHooks()
            .legend({
                position: 'bottom'
            })
            .datasets(['bar', 'bar', 'bar', {
                type: 'line',
                fill: false
            }])
            .tooltip(true)
    });
</script>
@endpush
