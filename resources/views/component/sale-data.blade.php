@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    .td-group .main-data {
        font-weight: bold;
    }

    .td-group .secondary-data {
        font-size: 12px;
        display: block;
    }

    /* SKELETON STYLE */
    @keyframes skeletonPulse {
        0% {
            background-position: -200px 0;
        }

        100% {
            background-position: 200px 0;
        }
    }

    .skel-bar {
        height: 12px;
        border-radius: 4px;
        background: linear-gradient(90deg, #eee 25%, #ddd 37%, #eee 63%);
        background-size: 400px 100%;
        animation: skeletonPulse 1.4s ease-in-out infinite;
    }

    .truck-icon {
        display: inline-block;
        animation: truckMove 1.2s ease-in-out infinite;
    }

    @keyframes truckMove {
        0%, 100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(4px);
        }
    }

</style>
@endpush

@section('title','Unit Sales')
@section('page-title','Unit Sales')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale.index') }}">Unit Sales</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
                <h4 class="card-title">Unit Sales Data</h4>
        </div>
        <div class="card-body">
            {{-- Search --}}
            <div class="mb-3">
                <input type="text" class="form-control" id="searchSale"
                    placeholder="Cari SPK No, Customer Info, Unit, Salesman">
            </div>

            <div class="paginationSale"></div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Payment Method</th>
                            <th>Customer Info</th>
                            <th>Unit Info</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Payment Method</th>
                            <th>Customer Info</th>
                            <th>Unit Info</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbodyDo">

                    </tbody>
                </table>
            </div>
            <div class="paginationSale"></div>
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
    function ucwords(str) {

        if (!str) return '';

        return str.toLowerCase().replace(/\b\w/g, function (char) {
            return char.toUpperCase();
        });

    }

</script>

<script>
    function formatJam(date) {
        if (!date) return '-';

        return new Date(date).toLocaleTimeString('en-US', {
            timeZone: 'Asia/Makassar', // GMT+8 (WITA)
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        });
    }

</script>

<script>
    // LOADING ANIMATION
    function showSkeletonRows(count = 4) {
        let html = '';
        for (let i = 0; i < count; i++) {
            html += `
                <tr>
                    <td><div class="skel-bar" style="width:70%; margin-bottom:6px;"></div><div class="skel-bar" style="width:40%; height:9px;"></div></td>
                    <td><div class="skel-bar" style="width:80%; margin-bottom:6px;"></div><div class="skel-bar" style="width:50%; height:9px;"></div></td>
                    <td><div class="skel-bar" style="width:60%; margin-bottom:6px;"></div><div class="skel-bar" style="width:45%; height:9px;"></div></td>
                    <td><div class="skel-bar" style="width:50%;"></div></td>
                    <td><div class="skel-bar" style="width:50%;"></div></td>
                </tr>
            `;
        }
        $('#tbodyDo').html(html);
        $('.paginationSale').html('');
    }

    function loadDoData(page = 1) {
        showSkeletonRows(); // tampilkan skeleton sebelum request

        $.ajax({
            url: "{{ route('sale.data-ajax') }}",
            type: "GET",
            dataType: "json",
            data: {
                page: page,
                search: $('#searchSale').val()
            },
            success: function (res) {
                // CEK DATA KOSONG ATAU TIDAK
                if (res.data.data.length === 0) {
                    $('#tbodyDo').html(`
                        <tr>
                            <td colspan="4" class="text-center py-4" style="color:#999;">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    `);
                    $('.paginationSale').html('');
                    return;
                }

                let html = '';

                $.each(res.data.data, function (i, row) {

                    html += `
                        <tr>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">
                                        <span class="badge badge-dark mt-2">
                                            ${row.sale_date ? formatTanggal(row.sale_date) : '-'}
                                        </span>
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${ucwords(row.spk.payment_method)}</div>

                                        <div style="
                                            font-size: 11px; 
                                            font-style: italic;
                                            " 
                                            class="
                                            mb-1
                                            ${row.spk.credit_status == 'ACC'
                                            ? 'text-success' : 
                                                row.spk.credit_status == 'SURVEY'
                                                ? 'text-warning' :
                                                    row.spk.credit_status == 'REJECT'
                                                    ? 'text-danger' :
                                                        row.spk.credit_status == 'CANCEL'
                                                        ? 'text-dark' :
                                                            'text-primary'
                                            }
                                            ">
                                            ${row.spk.payment_method == 'CASH' ? row.spk.microfinance : row.spk.leasing}
                                            
                                            ${row.spk.payment_method == 'CREDITCARD' ? row.spk.credit_status : ''}
                                        </div>
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="td-group">
                                    <span class="main-data">
                                        <a href="/spk/get/${row.spk_no}" class="btnAction" target="_blank" style="font-size: 14px;"
                                        data-toggle="tooltip" data-placement="top" title="Show">${row.spk_no}</a>
                                        ${
                                            String(row.spk.order_status || '').trim().toUpperCase() === 'SOLD' 
                                            ? `<span class="badge badge-secondary
                                            "> ` 
                                            : `<span class="badge badge-success
                                            "> `
                                        }
                                                ${ucwords(row.spk.order_status)}
                                            </span>
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${row.spk.order_name} 
                                        ${
                                            row.spk.gender == 'MALE'
                                            ? `<span style="color: blue;"> ${row.spk.gender}`
                                            : `<span style="color: pink;"> ${row.spk.gender}`
                                        }</div>
                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">
                                        ${row.spk.spk_phone}
                                        </div>
                                        </div>
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="td-group">
                                    <span class="main-data">
                                    ${
                                        row.spk.frame_no == ''
                                        ? `<span class="badge badge-danger mt-2"> No Frame</span>`
                                        : `<span class="badge badge-primary mt-2"> ${row.spk.frame_no}</span>`
                                    }
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${row.spk.engine_no}</div>

                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">
                                        ${row.spk.year_mc ? row.spk.year_mc : ''}
                                        </div>

                                        <div style="font-size: 11px; font-style: italic; font-weight: bold;" class="mb-1">
                                        ${ucwords(row.spk.model_name)} - ${ucwords(row.spk.faktur_color)}
                                        </div>
                                    </span>
                                </div>
                            </td>

                            <td>${row.spk.manpower}</td>

                            <td>
                                <div class="form-button-action">
                                    <a href="/do-print/${row.spk_no}"
                                        class="btnAction"
                                        target="_blank"
                                        data-toggle="tooltip" data-placement="totitle="Print DO"
                                        style="color:red; cursor:pointer;">

                                        <i class="fas fa-print"></i>
                                    </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                    <a href="/spk-print/${row.spk_no}"
                                        class="btnAction"
                                        target="_blank"
                                        data-toggle="tooltip" data-placement="top" title="PrintSPK"
                                        style="color:maroon; cursor:pointer;">

                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                })
                $('#tbodyDo').html(html);

                $('[data-toggle="tooltip"]').tooltip();

                renderPaginationSale(res);
            },
            error: function (xhr) {
                $('#tbodyDo').html(
                    `<tr><td colspan="5" class="text-center py-4" style="color:#c0392b;">Gagal memuat data. Silakan coba lagi.</td></tr>`
                );
                console.log(xhr.status);
                console.log(xhr.responseJSON);
                console.log(xhr.responseText);
            }
        });
    }

    // SEARCH
    let timerDo;

    $('#searchSale').keyup(function () {
        clearTimeout(timerDo);

        timerDo = setTimeout(function () {
            loadDoData(1);
        }, 300);
    });

    // PAGINATION
    function renderPaginationSale(res) {
        let html = '';

        if (res.data.prev_page_url) {
            html += `
                <button class="btn btn-sm btn-secondary page"
                        data-page="${res.data.current_page - 1}">
                    ← Previous
                </button>
            `;
        }

        html += `
            <span class="mx-2">
                Page ${res.data.current_page} of ${res.data.last_page}
            </span>
        `;

        if (res.data.next_page_url) {
            html += `
                <button class="btn btn-sm btn-secondary page"
                        data-page="${res.data.current_page + 1}">
                    Next →
                </button>
            `;
        }

        $('.paginationSale').html(html);
    }

    $(document).on('click', '.page', function () {
        loadDoData($(this).data('page'));
    });

    function initRequestStock() {
        loadDoData();
    }

</script>
@endpush
