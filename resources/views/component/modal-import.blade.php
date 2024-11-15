<div class="modal fade modalImport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="route('allocation.import')" enctype="multipart/form-data">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Import Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    @csrf()
                    <div class="form-group form-floating-label">
                        <input id="excel" type="file" class="form-control input-border-bottom" name="excel">
                        <label for="excel" class="placeholder" style="
                                background-color: forestgreen; 
                                color: #ffffff !important; 
                                font-weight: bold;
                                width: 200px; 
                                padding-left: 20px; 
                                padding-right: 20px;
                                padding-top: 10px; 
                                border-radius: 5px;
                                position: absolute;
                                top: 20px;
                                cursor: pointer;"><i class="fas fa-file-excel"></i>&nbsp;&nbsp;Import File</label>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Import</button>
                    <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
                </div>
            </div>
        </form>

    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.pilihColor', function (e) {
        $('#color').val($(this).attr('data-code'));
        $('#colorName').val($(this).attr('data-color'));
        $('.modalColor').modal('hide');
    });

    $(document).ready(function () {
        $('#basic-datatables-color').DataTable({
            "pageLength": 20
        });
    });

</script>
@endpush
