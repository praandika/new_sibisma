@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Branch Delivery')
@section('page-title','Branch Delivery')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('branch-delivery.index') }}">Data Branch Delivery</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Branch Delivery Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>Dealer</th>
                            <th>Model Name</th>
                            <th>Frame No</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Driver</th>
                            <th>PIC</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>Dealer</th>
                            <th>Model Name</th>
                            <th>Frame No</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Driver</th>
                            <th>PIC</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($o->branch_delivery_date)->format('j M Y') }}</td>
                            <td>{{ $o->status }}</td>
                            <td>{{ $o->out->dealer->dealer_name }}</td>
                            <td style="background-color: <?php echo $o->out->stock->unit->color->color_code ?>50 ;">
                                {{ $o->out->stock->unit->model_name }}
                            </td>
                            <td>{{ $o->out->frame_no }}</td>
                            <td>{{ $o->out->dealer->address }}</td>
                            <td>{{ $o->out->dealer->phone }}</td>
                            <td>{{ $o->mainDriver->name }}</td>
                            <td>{{ $o->backupDriver->name }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('branch-delivery.show', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('branch-delivery.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('branch-delivery.delete', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus branch delivery {{ $o->out->dealer->name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
