<div class="modal fade modalRequestStock" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Request Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="alert alert-warning mb-4">

                    <i class="fas fa-exclamation-triangle mr-2"></i>

                    Unit ini bukan berada di dealer Anda.
                    Request stock akan dikirim ke dealer
                    <span class="badge badge-secondary">
                        <strong id="reqDealer"></strong>
                    </span>
                </div>

                <table class="table table-bordered table-sm">
                    <tr>
                        <th width="180">Request To</th>
                        <td id="reqDealerName"></td>
                    </tr>

                    <tr>
                        <th width="180">Model</th>
                        <td id="reqModel"></td>
                    </tr>

                    <tr>
                        <th>Warna</th>
                        <td id="reqColor"></td>
                    </tr>

                    <tr>
                        <th>Tahun</th>
                        <td id="reqYear"></td>
                    </tr>

                    <tr>
                        <th>Harga OTR</th>
                        <td id="reqPrice"></td>
                    </tr>

                </table>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">

                        <i class="fas fa-times"></i>
                        Cancel

                    </button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-warning" id="btnConfirmRequest">

                        <i class="fas fa-paper-plane"></i>
                        Kirim Request
                    </button>
                </div>
            </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#btnConfirmRequest').click(function () {

        $('#request_type').val('request_stock');

        $('#form').submit();

    });
</script>
@endpush