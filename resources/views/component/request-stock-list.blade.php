<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
            <h4 class="card-title">Request Stock</h4>
        </div>
        <div class="card-body">
            {{-- Search --}}
            <div class="mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="searchSpk"
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

        return str.toLowerCase().replace(/\b\w/g, function(char) {
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
    function loadSpkData(page = 1) {
        $.ajax({
            url: "{{ route('listrequeststock') }}",
            type: "GET",
            dataType: "json",
            data: {
                page: page,
                search: $('#searchSpk').val()
            },
            success: function (data) {

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
                                        <span class="badge badge-secondary mt-2">
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
                                            : (row.order_status == 'ready' || row.order_status == 'READY'
                                                ? `<span class="badge badge-success"> ${ucwords(row.order_status)}</span>`
                                                : `<span class="badge badge-warning"> ${ucwords(row.order_status)}</span>`
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
                                    <a href="/spk/${row.id}/edit" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ${
                                        row.order_status == 'READY'
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

                renderPaginationSpk(data);
            },
            error: function (xhr) {
                console.log(xhr.status);
                console.log(xhr.responseJSON);
                console.log(xhr.responseText);
            }
        });
    }

    // SEARCH
    let timerSpk;

    $('#searchSpk').keyup(function(){
        clearTimeout(timerSpk);

        timerSpk = setTimeout(function(){
            loadSpkData(1);
        },300);
    });

    // PAGINATION
    function renderPaginationSpk(data)
    {
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

    function initRequestStock() {
        loadSpkData();
    }
</script>
@endpush