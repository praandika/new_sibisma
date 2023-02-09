<div class="modal fade modalColor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Color</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="basic-datatables-color" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Color Code</th>
                                <th>Color Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Color Code</th>
                                <th>Color Name</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($color as $o)
                            <tr data-id="{{ $o->id }}" data-code="{{ $o->color_code }}" data-color="{{ $o->color_name }}" class="pilihColor">
                                <td style="background-color: <?php echo $o->color_code ?>50 ;">{{ $o->color_code }}</td>
                                <td>{{ $o->color_name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
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
