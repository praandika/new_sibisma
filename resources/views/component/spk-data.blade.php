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

</style>
@endpush

@section('title','SPK')
@section('page-title','SPK')

@if(Auth::user()->access == 'salesman')
@push('button')
@section('button-title','Create SPK')
@include('component.button-create-spk')
@endpush
@endif

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
            {{-- Search --}}
            <div class="mb-3">
                <input type="text" class="form-control" id="searchSpk"
                    placeholder="Cari SPK No, Customer Info, Unit, Salesman">
            </div>

            <div class="paginationSpk"></div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Status and Time</th>
                            <th>SPK Info</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Status and Time</th>
                            <th>SPK Info</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbodySpk">

                    </tbody>
                </table>
            </div>
            <div class="paginationSpk"></div>
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
                    <td><div class="skel-bar" style="width:40%;"></div></td>
                </tr>
            `;
        }
        $('#tbodySpk').html(html);
        $('.paginationSpk').html('');
    }

    function loadSpkData(page = 1) {
        showSkeletonRows(); // tampilkan skeleton sebelum request

        $.ajax({
            url: "{{ route('spk.data') }}",
            type: "GET",
            dataType: "json",
            data: {
                page: page,
                search: $('#searchSpk').val()
            },
            success: function (res) {
                // CEK DATA KOSONG ATAU TIDAK
                if (res.data.data.length === 0) {
                    $('#tbodySpk').html(`
                        <tr>
                            <td colspan="5" class="text-center py-4" style="color:#999;">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    `);
                    $('.paginationSpk').html('');
                    return;
                }

                let html = '';

                $.each(res.data.data, function (i, row) {

                    // CEK KELENGKAPAN DATA
                    const lengkap =
                        String(row.ktp_number ?? '').trim() !== '' &&
                        String(row.spk_phone ?? '').trim() !== '' &&
                        String(row.address_shipment ?? '').trim() !== '' &&
                        String(row.address ?? '').trim() !== '' &&
                        String(row.frame_no ?? '').trim() !== '' &&
                        String(row.faktur_color ?? '').trim() !== '' &&
                        String(row.ktp ?? '').trim() !== '' &&
                        String(row.stnk_name ?? '').trim() !== '';

                    html += `
                        <tr>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">
                                        <span class="badge badge-dark mt-2">
                                            ${row.spk_date ? formatTanggal(row.spk_date) : '-'}
                                        </span>
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${row.created_at ? formatJam(row.created_at) : '-'}</div>
                                            <div style="font-size: 11px; font-style: italic;" class="mb-1">${row.sales_status == 'sold' ? 'DO: ' + formatTanggal(row.do_date) : ''}</div>
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${ucwords(row.payment_method)}</div>

                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">${row.payment_method == 'CASH' ? row.microfinance : row.leasing}</div>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">
                                        <a href="/spk/get/${row.spk_no}" class="btnAction" target="_blank" style="font-size: 14px;"
                                        data-toggle="tooltip" data-placement="top" title="Show">${row.spk_no}</a>
                                        ${
                                            row.order_status == 'indent' || row.order_status == 'INDENT'
                                            ? `<span class="badge badge-danger"> ${ucwords(row.order_status)}</span>`
                                            : (
                                                row.order_status == 'ready' || row.order_status == 'READY' && lengkap
                                                ? `<span class="badge badge-secondary">Ready to Sale</span>`
                                                : (
                                                    row.order_status == 'ready' || row.order_status == 'READY'
                                                    ? `<span class="badge badge-success">${ucwords(row.order_status)}</span>`
                                                    : `<span class="badge badge-warning"> ${ucwords(row.order_status)}</span>`
                                                )
                                            )
                                        }
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${row.order_name} 
                                        ${
                                            row.gender == 'MALE'
                                            ? `<span style="color: blue;"> ${row.gender}`
                                            : `<span style="color: pink;"> ${row.gender}`
                                        }</div>
                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">
                                        ${row.spk_phone}
                                        </div>
                                        <div style="font-size: 11px; font-style: italic; font-weight: bold;" class="mb-1">
                                        ${ucwords(row.model_name)} - ${ucwords(row.faktur_color)}
                                        </div>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="td-group">
                                    <span class="main-data">
                                    ${
                                        row.frame_no == ''
                                        ? `<span class="badge badge-danger"> No Frame</span>`
                                        : `<span class="badge badge-primary"> ${row.frame_no}</span>`
                                    }
                                    </span>
                                    <span class="secondary-data">
                                        <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${row.engine_no}</div>

                                        <div style="font-size: 11px; font-style: italic;" class="mb-1">
                                        ${row.year_mc ? row.year_mc : ''}
                                        </div>
                                    </span>
                                </div>
                            </td>
                            <td>${row.manpower}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="/spk/${row.id}/edit" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ${
                                        row.order_status == 'READY' && lengkap
                                        ? `<a href="/spk/get/${row.spk_no}" class="btnAction"
                                        target="_blank"
                                        data-toggle="tooltip" data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fas fa-eye"></i></a>`
                                        : `<span></span>`
                                    }
                                </div>
                            </td>
                        </tr>
                    `;
                })
                $('#tbodySpk').html(html);

                renderPaginationSpk(res);
            },
            error: function (xhr) {
                $('#tbodySpk').html(
                    `<tr><td colspan="5" class="text-center py-4" style="color:#c0392b;">Gagal memuat data. Silakan coba lagi.</td></tr>`
                );
                console.log(xhr.status);
                console.log(xhr.responseJSON);
                console.log(xhr.responseText);
            }
        });
    }

    // SEARCH
    let timerSpk;

    $('#searchSpk').keyup(function () {
        clearTimeout(timerSpk);

        timerSpk = setTimeout(function () {
            loadSpkData(1);
        }, 300);
    });

    // PAGINATION
    function renderPaginationSpk(res) {
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

        $('.paginationSpk').html(html);
    }

    $(document).on('click', '.page', function () {
        loadSpkData($(this).data('page'));
    });

    function initRequestStock() {
        loadSpkData();
    }

</script>
@endpush
