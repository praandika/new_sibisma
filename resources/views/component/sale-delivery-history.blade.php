@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Sales Delivery History')
@section('page-title','Sales Delivery History')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale-delivery.index') }}">Data Sales Delivery History</a>
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
            <h4 class="card-title">Sales Delivery History Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Delivery Date</th>
                            <th>Customer</th>
                            <th>Model Name</th>
                            <th>Frame No</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Driver</th>
                            <th>PIC</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Delivery Date</th>
                            <th>Customer</th>
                            <th>Model Name</th>
                            <th>Frame No</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Driver</th>
                            <th>PIC</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($o->sale_delivery_date)->format('j M Y') }}</td>
                            <td>{{ $o->sale->customer_name }}</td>
                            <td style="background-color: <?php echo $o->sale->stock->unit->color->color_code ?>50 ;">
                                {{ $o->sale->stock->unit->model_name }}
                            </td>
                            <td>{{ $o->sale->frame_no }}</td>
                            <td>{{ $o->sale->address }}</td>
                            <td>{{ $o->sale->phone }}</td>
                            <td>{{ $o->mainDriver->name ?? 'None' }}</td>
                            <td>{{ $o->backupDriver->name ?? 'None' }}</td>
                            <td>{{ $o->note }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('sale-delivery.show', $o->delivery_id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('sale-delivery.edit', $o->delivery_id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('sale-delivery.delete', $o->delivery_id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus sale delivery {{ $o->sale->customer_name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
