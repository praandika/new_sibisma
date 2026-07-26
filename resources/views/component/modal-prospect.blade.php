<div class="modal fade modalProspect" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data Prospect</h5>
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
                        id="searchProspect"
                        placeholder="Cari Customer / KTP">
                </div>

                <div class="table-responsive">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>KTP</th>
                                <th>Phone</th>
                                <th>Motor</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>KTP</th>
                                <th>Phone</th>
                                <th>Motor</th>
                                <th>Address</th>
                            </tr>
                        </tfoot>
                        <tbody id="tbodyProspect" style="cursor:pointer;">
                            
                        </tbody>
                    </table>
                </div>

                <div id="paginationProspect"></div>
            </div>
            <!-- Modal Footer -->
            @include('component.modal-footer')
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('.modalProspect').on('shown.bs.modal', function () {
        loadProspect();
    });

    // AJAX
    function loadProspect(page = 1)
    {
        $.get('/prospect-search', {
            search: $('#searchProspect').val(),
            page: page
        }, function(res){

            let html = '';

            $.each(res.data, function(i,row){

                html += `
                <tr class="pilih"
                    data-name="${row.customer_name}"
                    data-ktp="${row.ktp_no}"
                    data-phone="${row.phone}"
                    data-model="${row.interest_type}"
                    data-color="${row.interest_color}"
                    data-address="${row.address}"
                    data-dealer="${row.dealer_code}">
                    <td>${row.customer_name}</td>
                    <td>${row.ktp_no}</td>
                    <td>${row.phone}</td>
                    <td>${row.interest_type}</td>
                    <td>${row.address}</td>
                </tr>`;
            });

            $('#tbodyProspect').html(html);

            renderPagination(res);
        });
    }

    // SEARCH
    let timer;

    $('#searchProspect').keyup(function(){
        clearTimeout(timer);
        timer = setTimeout(function(){
            loadProspect();
        },300);
    });

    // PAGINATION
    function renderPagination(res)
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

        $('#paginationProspect').html(html);
    }

    $(document).on('click','.page-btn',function(){
        loadProspect($(this).data('page'));
    });
</script>

<script>
    $(document).on('click', '.pilih', function (e) {
        $('#customer_name').val($(this).attr('data-name'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#address_shipment').val($(this).attr('data-address'));
        $('.modalProspect').modal('hide');

        // CEK STOCK
        let model  = $(this).attr('data-model');
        let color  = $(this).attr('data-color');
        console.log(model);
        console.log(color);

        checkStock(model, color);

        // Lanjut Function Check Stock di Form
    });
</script>
@endpush
