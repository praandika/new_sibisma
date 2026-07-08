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
                    <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Tenor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Tenor</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr data-tenor="12" class="pilihTenor">
                                <td>Tenor 12</td>
                            </tr>
                            <tr data-tenor="24" class="pilihTenor">
                                <td>Tenor 24</td>
                            </tr>
                            <tr data-tenor="36" class="pilihTenor">
                                <td>Tenor 36</td>
                            </tr>
                            <tr data-tenor="48" class="pilihTenor">
                                <td>Tenor 48</td>
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
