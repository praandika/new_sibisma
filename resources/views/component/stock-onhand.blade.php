@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Stock')
@section('page-title','Stock')

@if(Auth::user()-> access == 'owner')
    @push('button')
        @include('component.button-print')
    @endpush
@endif

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('stock.index') }}">Data Stock</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover"
                        width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Model Name</th>
                                <th>Frame No</th>
                                <th>Color</th>
                                <th>Year</th>
                                <th>Receive Time</th>
                                <th>Status</th>
                                <th>Dealer</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Model Name</th>
                                <th>Frame No</th>
                                <th>Color</th>
                                <th>Year</th>
                                <th>Receive Time</th>
                                <th>Status</th>
                                <th>Dealer</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php($no = 1)
                            @forelse($data as $o)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $o->model_name }}</td>
                                <td>{{ $o->frame_no }}</td>
                                <td>{{ $o->faktur_color }}</td>
                                <td>{{ $o->year_mc }}</td>
                                <td>{{ $o->receive_time }}</td>
                                <td>{{ $o->status }}</td>
                                <td>{{ $o->point_code }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('stock.show', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Detail"
                                            style="color:orange;"><i class="fa fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
