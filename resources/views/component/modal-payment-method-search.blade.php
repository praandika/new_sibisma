<div class="modal fade modalPaymentMethodSearch" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            <tr data-payment-method="cash" class="pilihPaymentMethodSearch">
                                <td>Cash</td>
                            </tr>
                            <tr data-payment-method="credit" class="pilihPaymentMethodSearch">
                                <td>Credit</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Footer -->
            @include('component.modal-footer')
        </div>
    </div>
</div>

@push('after-script')
    <script>
        $(document).on('click', '.pilihPaymentMethodSearch', function (e) {
            $('#paymentMethod').val($(this).attr('data-payment-method'));
            $('.modalPaymentMethodSearch').modal('hide');
        });
    </script>
@endpush
