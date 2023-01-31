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
    <a href="{{ route('sale.index') }}">Data SPK</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">SPK Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>SPK No</th>
                            <th>Name</th>
                            <th>STNK Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Unit</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>SPK No</th>
                            <th>Name</th>
                            <th>STNK Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Unit</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $o->spk_date }}</td>
                            <td>{{ $o->spk_no }}</td>
                            <td>{{ $o->order_name }}</td>
                            <td>{{ $o->stnk_name }}</td>
                            <td>{{ $o->phone }}</td>
                            <td>{{ $o->address }}</td>
                            <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">{{ $o->stock->unit->model_name }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('sale.delete', Auth::user()->dealer_code == 'group' ? $o->id : $o->id_sale) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus sale {{ $o->stock->unit->model_name }}?')"><i
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
