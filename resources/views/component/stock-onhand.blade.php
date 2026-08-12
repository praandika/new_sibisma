@push('after-css')
<style>
    .tbModal tr:nth-child(even) {
        background-color: #ededed !important;
    }

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

@section('title','Stock On-Hand')
@section('page-title','Stock On-Hand')

@if(Auth::user()-> access == 'owner')
@push('button')
@include('component.button-print')
@endpush
@endif

@if(Auth::user()-> access != 'salesman')
@push('button')
<button id="btnSyncManifest" 
        class="btn btn-dark btn-round">
    <i class="fas fa-sync mr-1"></i> Sync Stock
</button>
@endpush
@endif

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('stock.onhand') }}">Data Stock On-Hand</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock On-Hand Data</h4>
        </div>
        <div class="card-body">
            {{-- Search --}}
            <div class="mb-3">
                <input type="text" class="form-control" id="searchStock" placeholder="Cari Stock">
            </div>

            <div class="paginationStock"></div>

            <div class="table-responsive">
                <table class="table tbModal" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Model Info</th>
                            <th>Frame Info</th>
                            <th>Faktur Color</th>
                            <th>Receive Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Model Info</th>
                            <th>Frame Info</th>
                            <th>Faktur Color</th>
                            <th>Receive Time</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbodyStock" style="cursor:pointer;">

                    </tbody>
                </table>
            </div>

            <div class="paginationStock"></div>
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
    // Format Rupiah
    function formatRupiah(angka) {
        angka = angka.toString().replace(/\D/g, '');

        if (angka == '') return '';

        return 'Rp ' + Number(angka).toLocaleString('id-ID');
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
                <td><div class="skel-bar" style="width:40%;"></div></td>
            </tr>
        `;
        }
        $('#tbodyStock').html(html);
        $('.paginationStock').html('');
    }

    function loadStock(page = 1) {
        showSkeletonRows(); // tampilkan skeleton sebelum request

        $.ajax({
            url: "{{ route('stock.onhand-ajax') }}",
            type: "GET",
            dataType: "json",
            data: {
                page: page,
                search: $('#searchStock').val()
            },
            success: function (data) {
                // CEK DATA KOSONG ATAU TIDAK
                if (data.data.length === 0) {
                    $('#tbodyStock').html(`
                    <tr>
                        <td colspan="6" class="text-center py-4" style="color:#999;">
                            Data tidak ditemukan
                        </td>
                    </tr>
                `);
                    $('.paginationStock').html('');
                    return;
                }

                let html = '';

                $.each(data.data, function (i, row) {
                    let nomor = (data.current_page - 1) * data.per_page + i + 1;

                    html += `
                    <tr class="pilihStock"
                        data-model="${row.model_name}"
                        data-frame="${row.frame_no}"
                        data-engine="${row.engine_no}"
                        data-color="${row.faktur_color}"
                        data-price="${row.price}"
                        data-dealer="${row.dealer_name}"
                        data-point-code="${row.point_code}"
                        data-year="${row.year_mc}">

                        <td>${nomor}</td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${row.model_name}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-style: italic;" class="mb-1">${formatRupiah(row.price)}
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${row.frame_no}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;">${row.engine_no}</div>
                                    <div style="font-size: 11px; font-style: italic;" class="mb-1">${row.year_mc}
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${ucwords(row.faktur_color)}</span>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${formatTanggal(row.receive_time)}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.dealer_code}</div>
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.dealer_name}</div>
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data"><span class="badge badge-success">${ucwords(row.status)}</span></span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">
                                    ${row.info.toUpperCase()}
                                    </div>
                                </span>
                            </div>
                        </td>
                    </tr>`;
                })
                $('#tbodyStock').html(html);

                renderpaginationStock(data);
            },
            error: function (xhr) {
                $('#tbodyStock').html(
                    `<tr><td colspan="6" class="text-center py-4" style="color:#c0392b;">Gagal memuat data. Silakan coba lagi.</td></tr>`
                );
                console.log(xhr.status);
                console.log(xhr.responseJSON);
                console.log(xhr.responseText);
            }
        });
    }

    // SEARCH
    let timerSpk;

    $('#searchStock').keyup(function () {
        clearTimeout(timerSpk);

        timerSpk = setTimeout(function () {
            loadStock(1);
        }, 300);
    });

    // PAGINATION
    function renderpaginationStock(data) {
        let html = '';

        if (data.prev_page_url) {
            html += `
                <button class="btn btn-sm btn-secondary page"
                        data-page="${data.current_page - 1}">
                    ← Previous
                </button>
            `;
        }

        html += `
            <span class="mx-2">
                Page ${data.current_page} of ${data.last_page}
            </span>
        `;

        if (data.next_page_url) {
            html += `
                <button class="btn btn-sm btn-secondary page"
                        data-page="${data.current_page + 1}">
                    Next →
                </button>
            `;
        }

        $('.paginationStock').html(html);
    }

    loadStock(1);

    $(document).on('click', '.page', function () {
        loadStock($(this).data('page'));
    });

</script>

<!-- SYNC MANUAL STOCK MANIFEST DPACK -->
 <script>
$(document).on('click', '#btnSyncManifest', function () {

    const btn = $(this);

    btn.prop('disabled', true);

    const originalHtml = btn.html();

    btn.html(`
        <i class="fas fa-spinner fa-spin mr-1"></i>
        Syncing...
    `);

    $.ajax({
        url: "{{ route('dpack.manual-manifest') }}",
        type: "POST",

        data: {
            _token: "{{ csrf_token() }}"
        },

        success: function (res) {

            console.log('SYNC SUCCESS:', res);

            if (typeof toast === 'function') {
                toast(res.message, 'success');
            } else {
                alert(res.message);
            }

            // Refresh data stock
            loadStock(1);
        },

        error: function (xhr) {

            console.log('SYNC ERROR:', xhr);

            let message = 'Sync manifest gagal.';

            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }

            if (typeof toast === 'function') {
                toast(message, 'error');
            } else {
                alert(message);
            }
        },

        complete: function () {

            btn.prop('disabled', false);
            btn.html(originalHtml);

        }
    });

});
</script>
@endpush
