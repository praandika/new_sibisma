<div class="modal fade modalEducation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            <tr class="pilihEducation" data-edu="SMA">
                                <td>SMA</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="SMK">
                                <td>SMK</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Diploma 1">
                                <td>Diploma 1</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Diploma 2">
                                <td>Diploma 2</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Diploma 3">
                                <td>Diploma 3</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Diploma 4">
                                <td>Diploma 4</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Sarjana 1">
                                <td>Sarjana 1</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Sarjana 2">
                                <td>Sarjana 2</td>
                            </tr>
                            <tr class="pilihEducation" data-edu="Sarjana 3">
                                <td>Sarjana 3</td>
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
    $(document).on('click', '.pilihEducation', function (e) {
        $('#education').val($(this).attr('data-edu'));
        $('.modalEducation').modal('hide');
    });
</script>
@endpush
