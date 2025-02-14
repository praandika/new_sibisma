@extends('layouts.main')

@section('content')
    @if(Route::is('dashboard'))
        @if(Auth::user()->access == 'salesman')
            @include('component.salesman-home')
        @elseif(Auth::user()->access == 'warehouse')
            @include('component.warehouse-home')
        @else
            @section('title','Dashboard')
            @section('page-title','Dashboard')

            @push('link-bread')
            <li class="nav-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @endpush
            
            <livewire:rank>
            <livewire:sale-chart>
            <livewire:ratio-stock>
            <livewire:sale-l-m>
            <livewire:sale-l-y>
            <livewire:stu-vs-real>
            <livewire:sale-by-dealer-chart>
            <livewire:top-product-chart>
            <livewire:top-stock-chart>
            <livewire:modal-ranking>
        @endif
    <!-- Dealer Page -->
    @elseif(Route::is('dealer.*'))
        @if(Route::is('dealer.edit'))
            @include('component.dealer-edit') 
        @else
            @include('component.dealer-create')
            @include('component.dealer-data')
        @endif

    <!-- Manpower Page -->
    @elseif(Route::is('manpower.*'))
        @if(Route::is('manpower.edit'))
            @include('component.manpower-edit')
        @elseif(Route::is('manpower.show'))
            @include('component.manpower-show')
        @else
            @include('component.manpower-create')
            @include('component.manpower-data')
        @endif

    <!-- ID Card Page -->
    @elseif(Route::is('idcard.*'))
        @if(Route::is('idcard.edit'))
            @include('component.idcard-edit')
        @elseif(Route::is('idcard.show'))
            @include('component.idcard-show')
        @elseif(Route::is('idcard.data'))
            @include('component.idcard-data')
        @else
            @include('component.idcard-dealer')
        @endif

    <!-- Dokumen Page -->
    @elseif(Route::is('document.*'))
        {{-- @include('component.dokumen-create') --}}
        @if(Route::is('document.show'))
            @include('component.dokumen-show')
        @elseif(Route::is('document.edit'))
            @include('component.dokumen-edit')
        @elseif(Route::is('document.history'))
            @include('component.search-box')
            @include('component.dokumen-history') 
        @else
            @include('component.dokumen-data')
        @endif

    <!-- Unit Page -->
    @elseif(Route::is('unit.*'))
        @if(Route::is('unit.edit'))
            @include('component.unit-edit')
        @elseif(Route::is('unit.show'))
            @include('component.unit-show')
        @elseif(Route::is('unit.add-all'))
            @include('component.unit-add-all')
        @else
            @include('component.unit-create')
            @include('component.unit-data')
        @endif

    <!-- Sparepart Page -->
    @elseif(Route::is('sparepart.*'))
        @if(Route::is('sparepart.edit'))
            @include('component.sparepart-edit')
        @elseif(Route::is('sparepart.show'))
            @include('component.sparepart-show')
        @else
            @include('component.sparepart-create')
            @include('component.sparepart-data')
        @endif

    <!-- Specification Page -->
    @elseif(Route::is('specification.*'))
        @if(Route::is('specification.edit'))
            @include('component.specification-edit')
        @elseif(Route::is('specification.show'))
            @include('component.specification-show')
        @else
            @include('component.specification-create')
            @include('component.specification-data')
        @endif

    <!-- Job Vacancy Page -->
    @elseif(Route::is('jobvacancy.*'))
        @if(Route::is('jobvacancy.edit'))
            @include('component.jobvacancy-edit')
        @elseif(Route::is('jobvacancy.show'))
            @include('component.jobvacancy-show')
        @else
            @include('component.jobvacancy-create')
            @include('component.jobvacancy-data')
        @endif

    <!-- About Us Page -->
    @elseif(Route::is('about.*'))
        @if(Route::is('about.edit'))
            @include('component.about-edit')
        @elseif(Route::is('about.show'))
            @include('component.about-show')
        @else
            @include('component.about-create')
            @include('component.about-data')
        @endif

    <!-- Banner Page -->
    @elseif(Route::is('banner.*'))
        @if(Route::is('banner.edit'))
            @include('component.banner-edit')
        @elseif(Route::is('banner.show'))
            @include('component.banner-show')
        @else
            @include('component.banner-create')
            @include('component.banner-data')
        @endif

    <!-- Color Page -->
    @elseif(Route::is('color.*'))
        @if(Route::is('color.edit'))
            @include('component.color-edit') 
        @else
            @include('component.color-create')
            @include('component.color-data')
        @endif

    <!-- Leasing Page -->
    @elseif(Route::is('leasing.*'))
        @if(Route::is('leasing.edit'))
            @include('component.leasing-edit') 
        @else
            @include('component.leasing-create')
            @include('component.leasing-data')
        @endif

    <!-- Stock Page -->
    @elseif(Route::is('stock.*'))
        @if(Route::is('stock.show'))
            @include('component.stock-show')
        @else
            @include('component.stock-create')
            @include('component.stock-data')
        @endif

    <!-- Allocation Page -->
    @elseif(Route::is('allocation.*'))
        @if(Route::is('allocation.detail'))
            @include('component.allocation-show')
        @elseif(Route::is('allocation.search'))
            @include('component.allocation-search')
        @elseif(Route::is('allocation.out'))
            @include('component.allocation-out')
        @elseif(Route::is('allocation.report'))
            @include('component.allocation-report')
        @else
            @include('component.allocation-create')
            @include('component.search-box')
            @include('component.allocation-data')
        @endif

    <!-- Sale Page -->
    @elseif(Route::is('sale.*'))
        @if(Route::is('sale.history'))
            <livewire:ratio-stock>
            <livewire:sale-l-m>
            <livewire:sale-l-y>
            <livewire:stu-vs-real>
            @include('component.search-box')
            @include('component.sale-history')
        @else
            @if(Auth::user()->crud == 'simple')
                @include('component.sale-simple-create')
            @else
                @include('component.sale-create')
            @endif
            <livewire:ratio-stock>
            <livewire:sale-l-m>
            <livewire:sale-l-y>
            <livewire:stu-vs-real>
            @include('component.sale-data')
        @endif

    <!-- Entry Page -->
    @elseif(Route::is('entry.*'))
        @if(Route::is('entry.history'))
            <livewire:ratio-stock>
            <livewire:entry-l-m>
            <livewire:entry-l-y>
            <livewire:stu-vs-real>
            @include('component.search-box')
            @include('component.entry-history')
        @else
            @include('component.entry-create')
            <livewire:ratio-stock>
            <livewire:entry-l-m>
            <livewire:entry-l-y>
            <livewire:stu-vs-real>
            @include('component.entry-data')
        @endif

    <!-- Out Page -->
    @elseif(Route::is('out.*'))
        @if(Route::is('out.history'))
            <livewire:ratio-stock>
            <livewire:out-l-m>
            <livewire:out-l-y>
            <livewire:stu-vs-real>
            @include('component.search-box')
            @include('component.out-history')
        @else
            @if(Auth::user()->crud == 'simple')
                @include('component.out-simple-create')
            @else
                @include('component.out-create')
            @endif
            <livewire:ratio-stock>
            <livewire:out-l-m>
            <livewire:out-l-y>
            <livewire:stu-vs-real>
            @include('component.out-data')
        @endif
    
    <!-- Opname Page -->
    @elseif(Route::is('opname.*'))
        @if(Route::is('opname.history'))
            @include('component.search-box')
            @include('component.opname-data')
        @else
            @include('component.opname-create')
            @include('component.opname-data')
        @endif

    <!-- Report -->

    @elseif(Route::is('report.*'))
        @if(Route::is('report.stock-history'))
            @include('component.search-box')
            @include('component.stock-history')
        @elseif(Route::is('report.send-report'))
            @include('component.send-report')
        @elseif(Route::is('report.send-group'))
            @include('component.send-group')
        @elseif(Route::is('report.search-id'))
            @include('component.search-report-id')
            @include('component.search-report-id-data')
        @elseif(Route::is('report.adjust'))
            @include('component.adjust-report')
        @elseif(Route::is('report.unit'))
            @include('component.unit-report')
        @endif

    <!-- Log Page -->
    @elseif(Route::is('log'))
        @include('component.search-box')
        @include('component.log-data')

    <!-- User Page -->
    @elseif(Route::is('user.*'))
        @if(Route::is('user.edit'))
            @include('component.user-edit')
        @elseif(Route::is('user.show'))
            @include('component.user-show')
        @elseif(Route::is('user.editpass'))
            @include('component.user-editpass')
        @else
            @include('component.user-create')
            @include('component.user-data')
        @endif

    <!-- Sale Delivery Page -->
    @elseif(Route::is('sale-delivery.*'))
        @if(Route::is('sale-delivery.history'))
            @include('component.search-box')
            @include('component.sale-delivery-history')
        @elseif(Route::is('sale-delivery.show'))
            @include('component.sale-delivery-show')
        @elseif(Route::is('sale-delivery.edit'))
            @include('component.sale-delivery-edit')
        @else
            @include('component.sale-delivery-create')
            @include('component.sale-delivery-data')
        @endif

    <!-- Branch Delivery Page -->
    @elseif(Route::is('branch-delivery.*'))
        @if(Route::is('branch-delivery.history'))
            @include('component.search-box')
            @include('component.branch-delivery-history')
        @elseif(Route::is('branch-delivery.show'))
            @include('component.branch-delivery-show')
        @elseif(Route::is('branch-delivery.edit'))
            @include('component.branch-delivery-edit')
        @else
            @include('component.branch-delivery-create')
            @include('component.branch-delivery-data')
        @endif

    <!-- Faktur Service Page -->
    @elseif(Route::is('stock-history.*'))
        @include('component.fns-create')

    <!-- Search Page -->
    @elseif(Route::is('search'))
        @include('component.search-data')
        @if(Route::is('stock.show'))
            @include('component.stock-show')
        @endif

    <!-- Detail Stock Ratio Page -->
    @elseif(Route::is('info.*'))
        @if(Route::is('info.stock-ratio'))
            <livewire:stock-ratio-detail>
        @elseif(Route::is('info.sale-ach'))
            @include('component.sale-ach')
        @elseif(Route::is('info.entry-ach'))
            @include('component.entry-ach')
        @elseif(Route::is('info.out-ach'))
            @include('component.out-ach')
        @elseif(Route::is('info.stu-real-ach'))
            @include('component.stu-real-ach')
        @endif

    <!-- Data STU -->
    @elseif(Route::is('stu.*'))
        @if(Route::is('stu.edit'))
            @include('component.stu-edit')
        @else
            @include('component.stu-create')
            @include('component.stu-data')
        @endif

    <!-- Data SPK -->
    @elseif(Route::is('spk.*'))
        @if(Route::is('spk.edit'))
            @include('component.spk-edit')
        @elseif(Route::is('spk.get'))
            @include('component.spk-show')
        @elseif(Route::is('spk.history'))
            @include('component.search-box')
            @include('component.spk-history')
        @elseif(Route::is('spk.filter'))
            @include('component.filter-box')
            @include('component.spk-filter')
        @elseif(Route::is('spk.salesman'))
            @include('component.spk-salesman')
        @elseif(Route::is('spk.historysalesman'))
            @include('component.spk-historysalesman')
        @else
            @include('component.spk-create')
            @include('component.spk-data')
        @endif

    <!-- Warehouse Page -->
    @elseif(Route::is('warehouse.*'))
        @if(Route::is('warehouse.entry'))
            @include('component.warehouse-entry')
        @elseif(Route::is('warehouse.detail'))
            @include('component.warehouse-detail')
        @elseif(Route::is('warehouse.generate'))
            @include('component.warehouse-generate')
        @else
            @include('component.search-box')
            @include('component.warehouse-data')
        @endif

    <!-- Warehouse Name Page -->
    @elseif(Route::is('warehousename.*'))
        @if(Route::is('warehousename.edit'))
            @include('component.warehousename-edit')
        @else
            @include('component.warehousename-create')
            @include('component.warehousename-data')
        @endif

    <!-- Data DO -->
    @elseif(Route::is('delivery-order.*'))
        @if(Route::is('delivery-order.history'))
            @include('component.search-box')
            @include('component.delivery-order-history')
        @else
            @include('component.delivery-order-data')
        @endif

    <!-- Data Kwitansi -->
    @elseif(Route::is('kwitansi.*'))
        @if(Route::is('kwitansi.history'))
            @include('component.search-box')
            @include('component.kwitansi-history')
        @else
            @include('component.kwitansi-data')
        @endif

    <!-- DO & Kwitansi for Leasing -->
    @elseif(Route::is('do-kwitansi.leasing'))
            @include('component.search-box')
            @include('component.do-kwitansi-leasing-data')
        
    @endif
    
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables').DataTable({
            "pageLength": 20,
            "ordering": false
        });

        $('#basic-table-position').DataTable({
            "pageLength": 20,
            "ordering": false
        });

        $('#multi-filter-select').DataTable({
            "pageLength": 20,
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $(
                            '<select class="form-control"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>')
                    });
                });
            }
        });
    });

</script>
@endpush
