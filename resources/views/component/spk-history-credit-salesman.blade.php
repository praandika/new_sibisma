@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    .td-group .main-data{
        font-weight: bold;
    }
    .td-group .secondary-data{
        font-size: 12px;
        display: block;
    }
</style>
@endpush

@section('title','SPK History Credit')
@section('page-title','SPK History Credit')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.salesman') }}">Data SPK Salesman</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">History Credit</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
            <h4 class="card-title">SPK History Credit Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables-spk-history" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>SPK No</th>
                            <th>Credit Status</th>
                            <th>Reason</th>
                            <th>Pemohon</th>
                            <th>Salesman</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>SPK No</th>
                            <th>Credit Status</th>
                            <th>Reason</th>
                            <th>Pemohon</th>
                            <th>Salesman</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse($data as $o)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td style="color:green;">
                                <div class="td-group">
                                    <span class="main-data">{{ ucwords($o->spk_date) }}</span>
                                    <span class="secondary-data">
                                        <span class="status-1">{{ ucwords($o->update_date) }}</span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">{{ $o->spk }}</span>
                                    <span class="secondary-data">
                                        <span class="status-1">{{ ucwords($o->order_name) }}</span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">{{ $o->leasing_code }}</span>
                                    <span class="secondary-data">
                                        <span class="status-1">{{ ucwords($o->credit_status) }}</span>
                                    </span>
                                </div>
                            </td>
                            <td>{{ $o->reason }}</td>
                            <td>{{ $o->pemohon_name }}</td>
                            <td>{{ $o->salesman }}</td>
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

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables-spk-history').DataTable({
            "pageLength": 20,
            "ordering": false
        });
    });
</script>
@endpush