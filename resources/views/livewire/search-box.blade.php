<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="badge badge-primary" style="font-size: 15px;"><i class="fas fa-print"></i> Print Report</h2>
        </div>
        <div class="card-body">
            <!-- FORM -->
            <form action="
            @if(Route::is('sale.*'))
                    {{ url('report/sale') }}
                @elseif(Route::is('entry.*'))
                    {{ url('report/entry') }}
                @elseif(Route::is('out.*'))
                    {{ url('report/out') }}
                @elseif(Route::is('delivery-order.*'))
                    {{ url('report/delivery-order') }}
                @elseif(Route::is('stock.sold'))
                    {{ url('report/stock-sold') }}
                @elseif(Route::is('stock.mutation'))
                    {{ url('report/stock-mutation') }}
                @elseif(Route::is('stock.requested'))
                    {{ url('report/stock-requested') }}
                @elseif(Route::is('report.*'))
                    {{ url('report/stock-history') }}
                @elseif(Route::is('document.*'))
                    {{ url('report/document') }}
                @elseif(Route::is('spk.*'))
                    {{ url('report/spk') }}
                @elseif(Route::is('log'))
                    {{ url('report/log') }}
                @elseif(Route::is('opname.*'))
                    {{ url('report/opname') }}
                @elseif(Route::is('spk.*'))
                    {{ url('report/spk') }}
                @elseif(Route::is('allocation.report'))
                    {{ url('allocation/report') }}
                @elseif(Route::is('warehouse.*'))
                    {{ url('report/warehouse') }}
                @else
                    #
            @endif
            " method="GET">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="start" value="{{ $start }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="end" value="{{ $end }}">
                                <!-- END FORM -->
                                <div
                                    class="input-group-prepend {{ $start == null || $end == null || Route::is('kwitansi.*') || Route::is('do-kwitansi.leasing') ? 'd-none' : 'd-block' }}">
                                    <button type="submit" class="btn btn-success" type="button" style="color: #fff;" data-toggle="tooltip"
                                        data-placement="top" title="Print"><i class="fas fa-print"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
