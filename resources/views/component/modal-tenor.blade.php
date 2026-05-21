<div class="modal fade modalTenor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Tenor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            <tr class="pilihTenor" data-tenor="6 Bulan">
                                <td>6 Bulan</td>
                            </tr>
                            <tr class="pilihTenor" data-tenor="12 Bulan">
                                <td>12 Bulan</td>
                            </tr>
                            <tr class="pilihTenor" data-tenor="24 Bulan">
                                <td>24 Bulan</td>
                            </tr>
                            <tr class="pilihTenor" data-tenor="36 Bulan">
                                <td>36 Bulan</td>
                            </tr>
                            <tr class="pilihTenor" data-tenor="48 Bulan">
                                <td>48 Bulan</td>
                            </tr>
                            <tr class="pilihTenor" data-tenor="60 Bulan">
                                <td>60 Bulan</td>
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
    $(document).on('click', '.pilihTenor', function (e) {
        $('#tenor').val($(this).attr('data-tenor'));
        $('.modalTenor').modal('hide');
    });
</script>
@endpush
