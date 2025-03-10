<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @if(Route::is('warehouse.*'))
            <h4 class="card-title">Search</h4>
            @endif
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <!-- FORM -->
                        <form action="
                            @if(Route::is('sale.*'))
                                {{ route('sale.history') }}
                            @elseif(Route::is('entry.*'))
                                {{ route('entry.history') }}
                            @elseif(Route::is('out.*'))
                                {{ route('out.history') }}
                            @elseif(Route::is('sale-delivery.*'))
                                {{ route('sale-delivery.history') }}
                            @elseif(Route::is('branch-delivery.*'))
                                {{ route('branch-delivery.history') }}
                            @elseif(Route::is('report.*'))
                                {{ route('report.stock-history') }}
                            @elseif(Route::is('document.*'))
                                {{ route('document.history') }}
                            @elseif(Route::is('spk.history'))
                                {{ route('spk.history') }}
                            @elseif(Route::is('delivery-order.*'))
                                {{ route('delivery-order.history') }}
                            @elseif(Route::is('kwitansi.*'))
                                {{ route('kwitansi.history') }}
                            @elseif(Route::is('log'))
                                {{ route('log') }}
                            @elseif(Route::is('opname.*'))
                                {{ route('opname.history') }}
                            @elseif(Route::is('allocation.index'))
                                {{ route('allocation.index') }}
                            @elseif(Route::is('allocation.report'))
                                {{ route('allocation.report') }}
                            @elseif(Route::is('do-kwitansi.leasing'))
                                {{ route('do-kwitansi.leasing') }}
                            @else
                                #
                            @endif
                            " method="get">
                            @csrf
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="start"
                                    value="{{ $start != null ? $start : null }}">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="" aria-label=""
                                aria-describedby="basic-addon1" name="end" value="{{ $end != null ? $end : null }}">
                            <div class="input-group-prepend">
                                <button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top"
                                    title="Search"><i class="fas fa-search"></i></button>
                            </div>
                            </form>
                            <!-- END FORM -->
                            @if (!Route::is('allocation.index'))
                            <div
                                class="input-group-prepend {{ $start == null || $end == null || Route::is('delivery-order.*') || Route::is('kwitansi.*') || Route::is('do-kwitansi.leasing') ? 'd-none' : 'd-block' }}">
                                <a href="
                                @if(Route::is('sale.*'))
                                    {{ url('report/sale/'.$start.'/'.$end) }}
                                @elseif(Route::is('entry.*'))
                                    {{ url('report/entry/'.$start.'/'.$end) }}
                                @elseif(Route::is('out.*'))
                                    {{ url('report/out/'.$start.'/'.$end) }}
                                @elseif(Route::is('sale-delivery.*'))
                                    {{ url('report/sale-delivery/'.$start.'/'.$end) }}
                                @elseif(Route::is('branch-delivery.*'))
                                    {{ url('report/branch-delivery/'.$start.'/'.$end) }}
                                @elseif(Route::is('report.*'))
                                    {{ url('report/stock-history/'.$start.'/'.$end) }}
                                @elseif(Route::is('document.*'))
                                    {{ url('report/document/'.$start.'/'.$end) }}
                                @elseif(Route::is('spk.*'))
                                    {{ url('report/spk/'.$start.'/'.$end) }}
                                @elseif(Route::is('log'))
                                    {{ url('report/log/'.$start.'/'.$end) }}
                                @elseif(Route::is('opname.*'))
                                    {{ url('report/opname/'.$start.'/'.$end) }}
                                @elseif(Route::is('spk.*'))
                                    {{ url('report/spk/'.$start.'/'.$end) }}
                                @elseif(Route::is('allocation.report'))
                                    {{ url('allocation/report/'.$start.'/'.$end) }}
                                @elseif(Route::is('warehouse.*'))
                                    {{ url('report/warehouse/'.$start.'/'.$end) }}
                                @else
                                    #
                                @endif
                                " class="btn btn-success" type="button" style="color: #fff;" data-toggle="tooltip"
                                    data-placement="top" title="Print"><i class="fas fa-print"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
