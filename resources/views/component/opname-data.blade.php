@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@if(Route::is('opname.history'))
    @section('title','Stock Opname History')
    @section('page-title','Stock Opname History')
@else
    @section('title','Stock Opname')
    @section('page-title','Stock Opname')
@endif

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale.index') }}">Data Stock Opname @if(Route::is('opname.history')) History @endif</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Opname  @if(Route::is('opname.history')) History @endif Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year</th>
                            <th>Qty</th>
                            <th>Opname</th>
                            <th>Difference</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year</th>
                            <th>Qty</th>
                            <th>Opname</th>
                            <th>Difference</th>
                            <th>Updated By</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->opname_date }}</td>
                            <td>{{ $o->stock->unit->model_name }}</td>
                            <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">
                                {{ $o->stock->unit->color->color_name }}
                            </td>
                            <td>{{ $o->stock->unit->year_mc }}</td>
                            <td style="background-color: #fcba0350;">{{ $o->stock_system }}</td>
                            <td style="background-color: #03fc1350;">{{ $o->stock_opname }}</td>
                            <td style="background-color: #fc037f50;">{{ $o->difference }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
