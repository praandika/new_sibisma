<div class="modal fade modalCreditStatus"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Select Credit Status
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="table-responsive">

                    <table class="display table table-striped table-hover"
                           width="100%"
                           style="text-align:center;">

                        <tbody>

                            <tr data-credit-status="survey"
                                data-label-reason="Survey"
                                class="pilihCreditStatus"
                                style="cursor:pointer;">
                                <td>Survey</td>
                            </tr>

                            <tr data-credit-status="acc"
                                data-label-reason="Acc"
                                class="pilihCreditStatus"
                                style="cursor:pointer;">
                                <td>Acc</td>
                            </tr>

                            <tr data-credit-status="reject"
                                data-label-reason="Reject"
                                class="pilihCreditStatus"
                                style="cursor:pointer;">
                                <td>Reject</td>
                            </tr>

                            <tr data-credit-status="cancel"
                                data-label-reason="Cancel"
                                class="pilihCreditStatus"
                                style="cursor:pointer;">
                                <td>Cancel</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            @include('component.modal-footer')

        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.pilihCreditStatus', function () {

        const status = $(this).data('credit-status');
        const label = $(this).data('label-reason');

        console.log('Status dipilih:', status);

        // Set status ke form edit
        $('#credit_status').val(status);

        // Jika REJECT / CANCEL
        if (status === 'reject' || status === 'cancel' || status === 'REJECT' || status === 'CANCEL') {

            $('#creditReasonGroup').slideDown(200);

            $('#creditReasonLabel').html(`
                Alasan ${label}
                <span class="text-danger">*</span>
            `);

            $('#reason')
                .val('')
                .prop('required', true)
                .focus();

        } else {

            // Survey / ACC
            $('#creditReasonGroup').slideUp(200);

            $('#reason')
                .val('')
                .prop('required', false);
        }

        // Tutup modal
        $('.modalCreditStatus').modal('hide');

    });
</script>
@endpush