@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Warehouse')
@section('page-title','Warehouse')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('warehouse.index') }}">Data Warehouse</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Warehouse</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Entry Date</th>
                            <th>Engine No.</th>
                            <th>Model Name</th>
                            <th>Gudang</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Entry Date</th>
                            <th>Engine No.</th>
                            <th>Model Name</th>
                            <th>Gudang</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($o->in_date)->isoFormat('D-M-Y') }}</td>
                            <td>{{ $o->engine_no }}</td>
                            <td>{{ $o->model_name }}</td>
                            <td>{{ $o->gudang }}</td>
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
