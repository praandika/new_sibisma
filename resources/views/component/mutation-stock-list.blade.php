<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Mutation Info</h4>
            <p class="text-success" style="font-size: 15px;">Stock mutasi <span style="font-weight: bold;">ke Cabang lain</span></p>
        </div>
        <div class="card-body">
            {{-- Search --}}
            <div class="mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="searchStock"
                    placeholder="Cari Stock...">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Mutation Time</th>
                            <th>Model Info</th>
                            <th>Frame Info</th>
                            <th>Receive Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mutation Time</th>
                            <th>Model Info</th>
                            <th>Frame Info</th>
                            <th>Receive Time</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbodyStock">

                    </tbody>
                </table>
            </div>
            <div id="paginationStock"></div>
        </div>
    </div>
</div>

@push('after-script')
<script>
// LOADING ANIMATION
function showSkeletonRows2(count = 4) {
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
    $('#tbodyStock').html(html);
    $('#paginationStock').html('');
}

function loadStockData(page = 1) {
    showSkeletonRows2(); // tampilkan skeleton sebelum request

    $.ajax({
        url: "{{ route('mutationrequeststock') }}",
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
                        <td colspan="5" class="text-center py-4" style="color:#999;">
                            Data tidak ditemukan
                        </td>
                    </tr>
                `);
                $('#paginationStock').html('');
                return;
            }

            let html = '';

            $.each(data.data, function (i, row) {
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
                        <td>
                            <span class="badge badge-secondary mt-2">
                                ${row.updated_at ? formatTanggal(row.updated_at) : '-'}
                            </span>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${row.model_name}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px;">${ucwords(row.faktur_color)}</div>
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.year_mc}</div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${row.frame_no}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold; font-style: italic;" class="mt-2">${row.engine_no}</div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${formatTanggal(row.receive_time)}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.dealer_code}</div>
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.dealer_name}</div>
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">
                                    <span class="badge badge-warning">${ucwords(row.status)}</span>
                                </span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.info.toUpperCase()}</div>
                                    </div>
                                </span>
                            </div>
                        </td>
                    </tr>`;
            })
            $('#tbodyStock').html(html);

            renderPaginationStock(data);
        },
        error: function (xhr) {
            $('#tbodyStock').html(
                `<tr><td colspan="5" class="text-center py-4" style="color:#c0392b;">Gagal memuat data. Silakan coba lagi.</td></tr>`
            );
            console.log(xhr.status);
            console.log(xhr.responseJSON);
            console.log(xhr.responseText);
        }
    });
}

    // SEARCH
    let timerStock;

    $('#searchStock').keyup(function(){
        clearTimeout(timerStock);

        timerStock = setTimeout(function(){
            loadStockData(1);
        },300);
    });

    // PAGINATION
    function renderPaginationStock(data)
    {
        let html = '';

        if (data.prev_page_url) {
            html += `
                <button class="btn btn-sm btn-secondary page-mutation"
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
                <button class="btn btn-sm btn-secondary page-mutation"
                        data-page="${data.current_page + 1}">
                    Next →
                </button>
            `;
        }

        $('#paginationStock').html(html);
    }

    $(document).on('click', '.page-mutation', function () {
        loadStockData($(this).data('page'));
    });

    function initRequestStock() {
        loadSpkData();
        loadStockData()
    }
</script>
@endpush