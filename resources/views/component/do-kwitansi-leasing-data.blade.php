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

@section('title','Leasing DO & Kwitansi')
@section('page-title','Leasing DO & Kwitansi')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('do-kwitansi.leasing') }}">Data Leasing DO & Kwitansi</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
            <h4 class="card-title">DO & Kwitansi for Leasing</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="basic-datatables-spk" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
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
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($o->sale_date)->format('j F Y') }}</td>
                            <td>
                                <a href="{{ route('spk.get', $o->spk) }}" target="_blank">
                                    {{ $o->spk }}
                                </a>
                            </td>
                            <td>{{ $o->customer_name }}</td>
                            <td>{{ $o->phone }}</td>
                            <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">{{ $o->stock->unit->model_name }}</td>
                            <td>{{ $o->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('do.print', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Print" style="color:forestgreen;"><i class="fa fa-print"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('do.download', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Download" style="color:crimson;"><i class="fa fa-file-pdf"></i></a>
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

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables-spk').DataTable({
            "pageLength": 20,
            "ordering": false
        });
    });
</script>
@endpush