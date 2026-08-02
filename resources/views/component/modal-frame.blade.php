@push('after-css')
<style>
    .tbModal tr:nth-child(even) {
        background-color: #ededed !important;
    }
</style>
@endpush
<div class="modal fade modalFrame" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data Frame</h5>
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
                        id="searchFrame"
                        placeholder="Cari Frame No.">
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
                        <tbody id="tbodyFrame" style="cursor:pointer;">
                            
                        </tbody>
                    </table>
                </div>

                <div id="paginationFrame"></div>
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
    function loadFrameModal(page = 1)
    {
        $.get('/spk-checkstock',{

            model : currentModel,
            color : currentColor,
            search: $('#searchFrame').val(),
            page  : page

        }, function(res){

            console.log("loadFrameModal jalan");
            console.log(res);
            let html='';

            $.each(res.data.data,function(i,row){

                html+=`
                <tr class="pilihFrame"
                    data-model="${row.model_name}"
                    data-frame="${row.frame_no}"
                    data-engine="${row.engine_no}"
                    data-color="${row.faktur_color}"
                    data-price="${row.price}"
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
                            </span>
                        </div>
                    </td>
                </tr>`;
            });

            $('#tbodyFrame').html(html);
            
            renderPaginationFrame(res);
        });
    }

    // SEARCH
    let timerFrame;

    $('#searchFrame').keyup(function(){
        clearTimeout(timerFrame);
        timerFrame = setTimeout(function(){
            loadFrameModal();
        },300);
    });

    // PAGINATION
    function renderPaginationFrame(res)
    {
        let htmlFrame = '';

        if(res.prev_page_url){
            htmlFrame += `<button class="btn btn-sm btn-secondary page-frame"
                        data-page="${res.current_page-1}">
                       ← Previous
                    </button>`;
        }

        htmlFrame += ` Page ${res.current_page} of ${res.last_page} `;

        if(res.next_page_url){
            htmlFrame += `<button class="btn btn-sm btn-secondary page-frame"
                        data-page="${res.current_page+1}">
                        Next →
                    </button>`;
        }

        $('#paginationFrame').html(htmlFrame);
    }

    $(document).on('click','.page-frame',function(){
        loadFrameModal($(this).data('page'));
    });
</script>

<script>
    $(document).on('click','.pilihFrame',function(){
        $('#frame_no').val($(this).data('frame'));
        $('#engine_no').val($(this).data('engine'));
        $('#color').val($(this).data('color'));
        $('#year').val($(this).data('year'));

        $('#frameStatus').text($(this).data('frame'));
        $('#engineStatus').text($(this).data('engine'));
        $('#colorStatus').text($(this).data('color'));
        $('#yearStatus').text($(this).data('year'));

        $('#stockStatus').html(
            '<span class="badge badge-success">READY</span>'
        );
        $('#order_status').val('READY');

        $('.modalFrame').modal('hide');

    });
</script>
@endpush
