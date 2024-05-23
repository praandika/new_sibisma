@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Specification')
@section('page-title','Specification')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('specification.index') }}">Data Specification</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Specification Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @csrf
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Mesin</th>
                            <th>Rangka</th>
                            <th>Dimensi</th>
                            <th>Kelistrikan</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Model Name</th>
                            <th>Mesin</th>
                            <th>Rangka</th>
                            <th>Dimensi</th>
                            <th>Kelistrikan</th>
                            <th width="120">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->model_name }}</td>
                            <td>{{ $o->mesin }}</td>
                            <td>{{ $o->rangka }}</td>
                            <td>{{ $o->dimensi }}</td>
                            <td>{{ $o->kelistrikan }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('specification.show', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Detail"
                                        style="color:orange;"><i class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('specification.edit', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('specification.delete', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus {{ $o->parts_name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
