@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Out History')
@section('page-title','Out History')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('out.index') }}">Data Out History</a>
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
            <h4 class="card-title">Out History Data</h4>
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
                            <th>Destination</th>
                            @if(Auth::user()->crud == 'normal')
                            <th>Frame No</th>
                            @endif
                            <th>Qty</th>
                            <th>Created By</th>
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
                            <th>Destination</th>
                            @if(Auth::user()->crud == 'normal')
                            <th>Frame No</th>
                            @endif
                            <th>Qty</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $o->stock->dealer->dealer_code }}</td>
                            <td>{{ \Carbon\Carbon::parse($o->out_date)->format('j M Y') }}</td>
                            <td>{{ $o->stock->unit->model_name }}</td>
                            <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">
                                {{ $o->stock->unit->color->color_name }}
                            </td>
                            <td>{{ $o->stock->unit->year_mc }}</td>
                            <td>{{ $o->dealer->dealer_name }}</td>
                            @if(Auth::user()->crud == 'normal')
                            <td>{{ $o->frame_no }}</td>
                            @endif
                            <td>{{ $o->out_qty }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('out.delete', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus out {{ $o->stock->unit->model_name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                        @if(Auth::user()->crud == 'normal')
                            <td colspan="11" style="text-align: center;">No data available</td>
                        @else
                            <td colspan="10" style="text-align: center;">No data available</td>
                        @endif
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
