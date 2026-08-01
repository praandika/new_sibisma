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

@section('title','SPK')
@section('page-title','SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">Data SPK</a>
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
                            <th>Waktu</th>
                            <th>SPK No</th>
                            <th>Customer Info</th>
                            <th>Phone</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>SPK No</th>
                            <th>Customer Info</th>
                            <th>Phone</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbodySpk">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    // Format Tanggal JS
    function formatTanggal(tanggal) {
        return new Date(tanggal).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }
</script>

<script>
    function loadSpkData() {
        $.ajax({
            url: "{{ route('spk.data') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let html = '';

                $.each(data, function (i, row) {
                    html += `
                        <tr>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">${row.order_status}</span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${ucwords(row.payment_method)}</div>
                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">${row.payment_method == 'CASH' ? row.microfinance : row.leasing}</div>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">${formatTanggal(row.spk_date)}</span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${row.created_at.toTimeString().split(' ')[0]}</div>
                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">${row.sales_status == 'sold' ? 'DO: ' + formatTanggal(row.do_date) : ''}</div>
                                    </span>
                                </div>
                            </td>
                            <td>${row.spk_no}</td>
                            <td class="text-center">${status}</td>
                            <td class="text-center">${row.total_data}</td>
                            <td>${row.message}</td>
                        </tr>
                    `;
                })
                $('#tbodySpk').html(html);
            },
            error: function (xhr, status, error) {
                console.error("Error loading SPK data:", error);
            }
        });
    }

    $(document).ready(function () {
        loadSpkData();
    });
</script>
@endpush