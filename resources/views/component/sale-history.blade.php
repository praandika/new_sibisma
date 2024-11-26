@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Sales History')
@section('page-title','Sales History')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale.index') }}">Data Sales History</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">History</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
                <h4 class="card-title">Sales History Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dealer</th>
                            <th>Date</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year</th>
                            @if(Auth::user()->crud == 'normal')
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Frame No</th>
                            @endif
                            <th>Qty</th>
                            @if(Auth::user()->crud == 'normal')
                            <th>Salesman</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Dealer</th>
                            <th>Date</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year</th>
                            @if(Auth::user()->crud == 'normal')
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Frame No</th>
                            @endif
                            <th>Qty</th>
                            @if(Auth::user()->crud == 'normal')
                            <th>Salesman</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($data == "null")
                            <tr>
                                @if(Auth::user()->crud == 'normal')
                                    <td colspan="12" style="text-align: center;">No data available</td>
                                @else
                                    <td colspan="8" style="text-align: center;">No data available</td>
                                @endif
                            </tr>
                        @else
                            @php($no = 1)
                            @forelse($data as $o)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $o->stock->dealer->dealer_code }}</td>
                                <td>{{ \Carbon\Carbon::parse($o->sale_date)->format('j M Y') }}</td>
                                <td>{{ $o->stock->unit->model_name }}</td>
                                <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">
                                    {{ $o->stock->unit->color->color_name }}
                                </td>
                                <td>{{ $o->stock->unit->year_mc }}</td>
                                @if(Auth::user()->crud == 'normal')
                                <td>{{ $o->customer_name }}</td>
                                <td>{{ $o->salesphone }}</td>
                                <td>{{ $o->frame_no }}</td>
                                @endif
                                <td>{{ $o->sale_qty }}</td>
                                @if(Auth::user()->crud == 'normal')
                                <td>{{ $o->salesman }}</td>
                                @endif
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('sale.delete', Auth::user()->dealer_code == 'group' ? $o->id_sale : $o->id_sale) }}"
                                            class="btnAction" data-toggle="tooltip" data-placement="top" title="Delete"
                                            style="color:red;"
                                            onclick="return tanya('Yakin hapus sale {{ $o->stock->unit->model_name }}?')"><i
                                                class="fas fa-trash-alt"></i></a>

                                        @if(Auth::user()->crud == 'normal')
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('sale.edit', Auth::user()->dealer_code == 'group' ? $o->id_sale : $o->id_sale) }}"
                                            class="btnAction" data-toggle="tooltip" data-placement="top" title="Edit"
                                            style="color:#19A7CE;"><i class="fas fa-edit"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                @if(Auth::user()->crud == 'normal')
                                <td colspan="12" style="text-align: center;">No data available</td>
                                @else
                                <td colspan="8" style="text-align: center;">No data available</td>
                                @endif
                            </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
