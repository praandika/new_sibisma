@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','SPK')
@section('page-title','SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('out.index') }}">Data SPK</a>
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
            <h4 class="card-title">SPK Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables-spk" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                            <th>SPK No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Unit</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                            <th>SPK No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Unit</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @forelse($data as $o)
                        <tr>
                            <td @if($o->order_status == 'indent') style="color:crimson;" @else style="color:green;" @endif>
                                {{ ucwords($o->order_status) }}
                            </td>
                            <td>{{ $o->spk_date }}</td>
                            <td>{{ $o->spk_no }}</td>
                            <td>{{ $o->order_name }}</td>
                            <td>{{ $o->phone }}</td>
                            <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">{{ $o->stock->unit->model_name }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('spk.get', $o->spk_no) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Show" style="color:orange;"><i
                                            class="fas fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('spk.edit', $o->id_spk) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('spk.delete',$o->id_spk) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus {{ $o->spk_no }} {{ $o->order_name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
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
