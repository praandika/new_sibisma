@push('after-css')
<style>
    .tbModal tr:nth-child(even) {
        background-color: #ededed !important;
    }
</style>
@endpush
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
                    <table class="table tbModal" width="100%">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Motor</th>
                                <th>Info</th>
                                <th>Dealer</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>Motor</th>
                                <th>Info</th>
                                <th>Dealer</th>
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
    function ucwords(str) {
        return str.toLowerCase().replace(/\b[a-z]/g, letter => letter.toUpperCase());
    }
</script>

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
                    <td>
                        <div class="td-group">
                            <span class="main-data">${ucwords(row.customer_name)}</span>
                            <span class="secondary-data">
                                <div style="font-size: 11px; dislay:inline-block;">${row.prospect_date}</div>
                                <div style="font-size: 11px; font-weight: bold;" class="mb-1">
                                ${
                                    row.ktp_no 
                                    ? `<span class="badge badge-primary"> ${row.ktp_no}`
                                    : `<span class="badge badge-danger"> no KTP`
                                }
                                </div>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="td-group">
                            <span class="main-data">${ucwords(row.interest_color)}</span>
                            <span class="secondary-data">
                                <div style="font-size: 11px; dislay:inline-block; font-weight: bold; font-style: italic;" class="mt-2">${ucwords(row.interest_type)}</div>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="td-group">
                            <span class="main-data">${row.phone}</span>
                            <span class="secondary-data">
                                <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${ucwords(row.address)}</div>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="td-group">
                            <span class="main-data">${row.point_code}</span>
                            <span class="secondary-data">
                                <div style="font-size: 11px; dislay:inline-block; font-weight: bold;">${ucwords(row.salesman)}</div>
                            </span>
                        </div>
                    </td>
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
