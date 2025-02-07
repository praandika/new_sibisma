@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Warehouse Name')
@section('page-title','Warehouse Name')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('warehousename.index') }}">Data Warehouse Name</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Warehouse Name</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->name }}</td>
                            <td>{{ $o->address }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('warehousename.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
