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
                <div class="table-responsive">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th>Model Name</th>
                                <th>Frame No</th>
                                <th>Faktur Color</th>
                                <th>Engine No</th>
                                <th>Year MC</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Model Name</th>
                                <th>Frame No</th>
                                <th>Faktur Color</th>
                                <th>Engine No</th>
                                <th>Year MC</th>
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
    function loadFrameModal(data)
    {
        console.log("loadFrameModal jalan");
        console.log(data);
        let html='';

        $.each(data,function(i,row){

            html+=`
            <tr class="pilihFrame"
                data-model="${row.model_name}"
                data-frame="${row.frame_no}"
                data-engine="${row.engine_no}"
                data-color="${row.faktur_color}"
                data-year="${row.year_mc}">
                <td>${row.model_name}</td>
                <td>${row.frame_no}</td>
                <td>${row.faktur_color}</td>
                <td>${row.engine_no}</td>
                <td>${row.year_mc}</td>
            </tr>`;
        });

        $('#tbodyFrame').html(html);
    }

    // PAGINATION
    function renderPaginationFrame(res)
    {
        let html = '';

        if(res.prev_page_url){
            html += `<button class="btn btn-sm btn-secondary page-btn"
                        data-page="${res.current_page-1}">
                        Previous
                    </button>`;
        }

        html += ` Page ${res.current_page} of ${res.last_page} `;

        if(res.next_page_url){
            html += `<button class="btn btn-sm btn-secondary page-btn"
                        data-page="${res.current_page+1}">
                        Next
                    </button>`;
        }

        $('#paginationFrame').html(html);
    }
</script>

<script>
    $(document).on('click','.pilihFrame',function(){
        $('#frame_no').val($(this).data('frame'));
        $('#engine_no').val($(this).data('engine'));
        $('#color').val($(this).data('color'));
        $('#year').val($(this).data('year'));

        $('#frame_no').prop('disabled',false);
        $('#engine_no').prop('disabled',false);
        $('#year').prop('disabled',false);
        $('#color').prop('disabled',false);

        $('#stockStatus').html(
            '<span class="badge badge-success">READY</span>'
        );

        $('.modalFrame').modal('hide');

    });
</script>
@endpush
