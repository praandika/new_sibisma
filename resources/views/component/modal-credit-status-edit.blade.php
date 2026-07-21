<div class="modal fade modalCreditStatus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Credit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            <tr data-credit-status="survey" data-label-reason="Survey" class="pilihCreditStatus">
                                <td>Survey</td>
                            </tr>
                            <tr data-credit-status="acc" data-label-reason="Acc" class="pilihCreditStatus">
                                <td>Acc</td>
                            </tr>
                            <tr data-credit-status="reject" data-label-reason="Reject" class="pilihCreditStatus">
                                <td>Reject</td>
                            </tr>
                            <tr data-credit-status="cancel" data-label-reason="Cancel" class="pilihCreditStatus">
                                <td>Cancel</td>
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
        $(document).on('click', '.pilihCreditStatus', function (e) {
            $('#credit_status').val($(this).attr('data-credit-status'));
            $('#reason-label').text($(this).attr('data-label-reason'));
            showReason();
            $('.modalCreditStatus').modal('hide');
        });
    </script>
@endpush
