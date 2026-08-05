@push('after-css')
<style>
    .tbModal tr:nth-child(even) {
        background-color: #ededed !important;
    }
</style>
@endpush
<div class="modal fade modalStock" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i style="color: red;" class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                {{-- Search --}}
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="searchStock"
                        placeholder="Cari Stock">
                </div>

                <!-- Toggle Dealer -->
                <div class="form-check">
                    <label class="form-check-label" style="border: 1px solid #ced4da; border-radius: 5px; padding: 10px; margin-bottom: 10px; background-color: #f8f9fa; cursor: pointer;">
                        <input class="form-check-input" id="onlyDealer" type="checkbox" value="" checked>
                        <span class="form-check-sign" for="onlyDealer">Dealer Saya</span>
                    </label>
                </div>

                <div class="table-responsive">
                    <table class="table tbModal" width="100%">
                        <thead>
                            <tr>
                                <th>Model Info</th>
                                <th>Faktur Color</th>
                                <th>Receive Time</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Model Info</th>
                                <th>Faktur Color</th>
                                <th>Receive Time</th>
                            </tr>
                        </tfoot>
                        <tbody id="tbodyStock" style="cursor:pointer;">
                            
                        </tbody>
                    </table>
                </div>

                <div id="paginationStock"></div>
            </div>
            <!-- Modal Footer -->
            @include('component.modal-footer')
        </div>
    </div>
</div>

@push('after-script')
<script>
    function ucwords(str) {
        return str.toLowerCase().replace(/\b[a-z]/g, letter => letter.toUpperCase());
    }
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
    // AJAX
    function loadStockModal(page = 1)
    {
        $.ajax({
            url: '/spk-datastock',
            type: 'GET',
            data: {
                search: $('#searchStock').val(),
                page: page,
                onlyDealer: $('#onlyDealer').is(':checked')
            },
            success: function(res){

                let html = '';

                $.each(res.data.data, function(i,row){
                    html+=`
                    <tr class="pilihStock"
                        data-model="${row.model_name}"
                        data-frame="${row.frame_no}"
                        data-engine="${row.engine_no}"
                        data-color="${row.faktur_color}"
                        data-price="${row.price}"
                        data-stock-type="${row.dealer_code == res.dealer ? 'On-Hand' : 'Request Stock'}"
                        data-year="${row.year_mc}">
                        <td>
                            <div class="td-group">
                                <span class="main-data">${row.frame_no}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;">${row.model_name}</div>
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">
                                    ${
                                        row.status == 'ready'
                                        ? `<span class="badge badge-primary"> ${row.status}`
                                        : `<span class="badge badge-danger"> ${row.status}`
                                    }
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${ucwords(row.faktur_color)}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold; font-style: italic;" class="mt-2">${row.engine_no}</div>
                                    <div style="font-size: 11px; font-style: italic;" class="mb-1">${row.year_mc}</div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="td-group">
                                <span class="main-data">${formatTanggal(row.receive_time)}</span>
                                <span class="secondary-data">
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">${row.dealer_code}</div>
                                    <div style="font-size: 11px; font-weight: bold;" class="mb-1">
                                    ${
                                        row.dealer_code == res.dealer
                                        ? `<span class="badge badge-success">On-Hand</span>`
                                        : `<span class="badge badge-warning">Request Stock</span>`
                                    }
                                    </div>
                                </span>
                            </div>
                        </td>
                    </tr>`;
                });

                $('#tbodyStock').html(html);

                renderPaginationStock(res);
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    }

    // RELOAD STOCK MODAL WHEN TOGGLE DEALER CHECKBOX
    $('#onlyDealer').change(function(){

        loadStockModal(1);

    });

    // SEARCH
    let timerStock;

    $('#searchStock').keyup(function(){
        clearTimeout(timerStock);
        timerStock = setTimeout(function(){
            loadStockModal();
        },300);
    });

    // PAGINATION
    function renderPaginationStock(res)
    {
        let htmlStock = '';

        if(res.data.prev_page_url){
            htmlStock += `<button class="btn btn-sm btn-secondary page-stock"
                        data-page="${res.data.current_page-1}">
                       ← Previous
                    </button>`;
        }

        htmlStock += ` Page ${res.data.current_page} of ${res.data.last_page} `;

        if(res.data.next_page_url){
            htmlStock += `<button class="btn btn-sm btn-secondary page-stock"
                        data-page="${res.data.current_page+1}">
                        Next →
                    </button>`;
        }

        $('#paginationStock').html(htmlStock);
    }

    $('.modalStock').on('shown.bs.modal', function () {
        loadStockModal(1);
    });

    $(document).on('click', '.page-stock', function () {
        let page = $(this).data('page');
        loadStockModal(page);
    });
</script>

<script>
    $(document).on('click','.pilihStock',function(){
        $('#frame_no').val($(this).data('frame'));
        $('#engine_no').val($(this).data('engine'));
        $('#color').val($(this).data('color'));
        $('#year').val($(this).data('year'));
        $('#model_name').val($(this).data('model'));
        $('#price').val($(this).data('price'));

        $('#frameStatus').text($(this).data('frame'));
        $('#engineStatus').text($(this).data('engine'));
        $('#colorStatus').text($(this).data('color'));
        $('#yearStatus').text($(this).data('year'));

        // status stock
        $('#stockStatus').html(
            $(this).data('stock-type') == 'On-Hand'
            ? '<span class="badge badge-success">' + $(this).data('stock-type') + '</span>'
            : '<span class="badge badge-warning">' + $(this).data('stock-type') + '</span>'
        );
        $('#order_status').val('READY');

        $('.modalStock').modal('hide');

    });
</script>
@endpush
