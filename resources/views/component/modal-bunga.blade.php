<div class="modal fade modalBunga" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Bunga</h5>
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
                                <th>Bunga</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Bunga</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr data-bunga="Menurun Reguler" class="pilihBunga">
                                <td>Bunga Menurun Reguler</td>
                            </tr>
                            <tr data-bunga="Menurun 1.85%" class="pilihBunga">
                                <td>Bunga Menurun 1.85%</td>
                            </tr>
                            <tr data-bunga="Menetap Reguler" class="pilihBunga">
                                <td>Bunga Menetap Reguler</td>
                            </tr>
                            <tr data-bunga="Menetap Poten" class="pilihBunga">
                                <td>Bunga Menetap Poten</td>
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
    $(document).on('click', '.pilihBunga', function (e) {
        $('#bunga').val($(this).attr('data-bunga'));
        $('.modalBunga').modal('hide');
    });
</script>
@endpush
