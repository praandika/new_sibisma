<div class="modal fade modalGender" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Gender</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            <tr class="pilihGender" data-gender="L" data-gendername="Male">
                                <td>Male</td>
                            </tr>
                            <tr class="pilihGender" data-gender="P" data-gendername="Female">
                                <td>Female</td>
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
    $(document).on('click', '.pilihGender', function (e) {
        $('#gender').val($(this).attr('data-gender'));
        $('#gender_name').val($(this).attr('data-gendername'));
        $('.modalGender').modal('hide');
    });
</script>
@endpush
