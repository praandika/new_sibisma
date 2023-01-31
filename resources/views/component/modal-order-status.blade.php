<div class="modal fade modalOrderStatus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Order Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            <tr data-order-status="indent" class="pilihOrderStatus">
                                <td>Indent</td>
                            </tr>
                            <tr data-order-status="available" class="pilihOrderStatus">
                                <td>Available</td>
                            </tr>
                        </tbody>
                    </table>
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
        $(document).on('click', '.pilihOrderStatus', function (e) {
            $('#order_status').val($(this).attr('data-order-status'));
            $('.modalOrderStatus').modal('hide');
        });
    </script>
@endpush
