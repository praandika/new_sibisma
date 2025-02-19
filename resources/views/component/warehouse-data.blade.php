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
            <h4 class="card-title">Warehouse Today</h4>
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
                            <td>
                                <div>{{ $o->engine_no }}</div>
                                <span style="
                                display: inline-block; 
                                font-size: 11px; 
                                padding: 2px 5px;
                                color: #fff;
                                background-color: {{ ($o->status == 'In Stock' ? '#346eeb' : ( $o->status == 'Move' ? '#02ba3f' : '#eb4034')) }};">
                                {{ $o->status }}</span>
                            </td>
                            <td>
                                <div>{{ $o->model_name }}</div>
                                <span style="
                                display: inline-block; 
                                font-size: 11px; 
                                padding: 2px 5px;
                                color: #000000;
                                background-color: {{ $o->color_code }}50;">
                                {{ $o->color_name }}</span>

                                <span style="
                                font-size: 11px; 
                                padding: 2px 5px;
                                color: #000000;
                                margin-left: 5px;
                                background-color: {{ $o->color_code }}50;">
                                {{ $o->year_mc }}</span>
                            </td>
                            <td>
                                <div>{{ $o->gudang }}</div>

                                <span style="font-size: 11px;">
                                Petugas :
                                </span>
                                <span style="
                                display: inline-block; 
                                font-size: 11px; 
                                padding: 2px 5px;
                                color: #fff;
                                background-color: {{ ($o->status == 'In Stock' ? '#346eeb' : ( $o->status == 'Move' ? '#02ba3f' : '#eb4034')) }};">
                                {{ $o->pic }}</span>

                                <span style="
                                display: inline-block; 
                                font-size: 11px; 
                                padding: 2px 5px;
                                color: #fff;
                                margin-left: 5px;
                                background-color: {{ ($o->status == 'In Stock' ? '#346eeb' : ( $o->status == 'Move' ? '#02ba3f' : '#eb4034')) }};">
                                {{ $o->note }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Belum ada unit masuk hari ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
