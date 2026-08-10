@push('after-css')
<style>
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

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Request Stock</h4>
        </div>
        <div class="card-body">
            {{-- Search --}}
            <div class="mb-3">
                <input type="text" class="form-control" id="searchSpk"
                    placeholder="Cari SPK No, Customer Info, Unit, Salesman">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Request Time</th>
                            <th>SPK Info</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Request Time</th>
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
            <div id="paginationSpk"></div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Reject --}}
<div class="modal fade" id="modalRejectSpk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle" style="color:#e0a800;"></i>
                    Konfirmasi Reject
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah kamu yakin reject request stock SPK <strong id="spkNoReject"></strong></p>
                <p class="mb-0">from Dealer: <strong id="dealerReject"></strong></p>
                <p class="mb-0">Model: <strong id="modelReject"></strong></p>
                <p class="text-muted" style="font-size:13px;">Tindakan ini tidak bisa dibatalkan setelah diproses.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="" id="btnConfirmRejectSpk" target="_blank" class="btn btn-danger">
                    <i class="fas fa-times"></i> Ya, Reject
                </a>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    const authDealerCode = @json(Auth::user()-> dealer_code);

    console.log('Dealer Login:', authDealerCode);

</script>
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
        $('#paginationSpk').html('');
    }

    function loadSpkData(page = 1) {
        showSkeletonRows(); // tampilkan skeleton sebelum request

        $.ajax({
            url: "{{ route('listrequeststock') }}",
            type: "GET",
            dataType: "json",
            data: {
                page: page,
                search: $('#searchSpk').val()
            },
            success: function (data) {
                // CEK DATA KOSONG ATAU TIDAK
                if (data.data.length === 0) {
                    $('#tbodySpk').html(`
                    <tr>
                        <td colspan="5" class="text-center py-4" style="color:#999;">
                            Data tidak ditemukan
                        </td>
                    </tr>
                `);
                    $('#paginationSpk').html('');
                    return;
                }

                let html = '';

                $.each(data.data, function (i, row) {
                    html += `
                    <tr>
                        <td>
                            <div class="td-group">
                                <span class="main-data">
                                    <div style="font-weight: bold;">Request From ${row.dealer_name}</div>
                                </span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px;" class="mb-1">
                                        Request from ${row.dealer_code} to ${row.point_code}
                                    </div>
                                    <span class="badge badge-dark mt-2">
                                        ${row.updated_at ? formatTanggal(row.updated_at) : '-'}
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">
                                    ${row.spk_no}
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
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">
                                    <div style="font-weight: bold;" class="mb-1">
                                    ${ucwords(row.model_name)} - ${ucwords(row.faktur_color)}
                                    </div>
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
                            ${
                                authDealerCode != 'group'
                                ? `<a href="/spk/change-stock/${row.spk_no}/${row.dealer_code}/${row.model_name}/${row.faktur_color}" class="btnAction"
                                    data-toggle="tooltip" data-placement="top" title="Approve"
                                        style="color:#5ad166;" target="_blank"><i
                                        class="fas fa-check"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:void(0);" class="btnAction btnRejectSpk"
                                        data-url="/spk/reject/${row.spk_no}/${row.dealer_code}"
                                        data-spkno="${row.spk_no}"
                                        data-dealer="${row.dealer_name}"
                                        data-model="${row.model_name}"
                                        data-toggle="tooltip" data-placement="top" title="Reject" style="color:red;"><i
                                        class="fas fa-times"></i></a>`
                                : `<a href="javascript:void(0);" disabled class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Approve"
                                            style="color:grey;"><i
                                                class="fas fa-check"></i></a>`
                            }
                            </div>
                        </td>
                    </tr>
                `;
                })
                $('#tbodySpk').html(html);

                renderPaginationSpk(data);
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
    function renderPaginationSpk(data) {
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

        $('#paginationSpk').html(html);
    }

    $(document).on('click', '.page', function () {
        loadSpkData($(this).data('page'));
    });

    // INIT LOAD DATA ADA DI BLADE MUTATION STOCK LIST

</script>

<script>
    // MODAL Reject SPK
    $(document).on('click', '.btnRejectSpk', function () {
        const url = $(this).data('url');
        const spkNo = $(this).data('spkno');
        const dealer = $(this).data('dealer');
        const model = $(this).data('model');

        $('#spkNoReject').text(spkNo);
        $('#btnConfirmRejectSpk').attr('href', url);
        $('#dealerReject').text(dealer);
        $('#modelReject').text(model);

        $('#modalRejectSpk').modal('show');
    });

    $('#btnConfirmRejectSpk').on('click', function () {
        $('#modalRejectSpk').modal('hide');
    });

</script>
@endpush
