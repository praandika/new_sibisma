<div class="modal fade modalGudang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data Gudang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i style="color: red;" class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tb-basic-table-position" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Gudang</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Gudang</th>
                                <th>Alamat</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($gudang as $o)
                            <tr data-gudang_name="{{ $o->name }}"
                                data-gudang_id="{{ $o->id }}"
                                data-address="{{ $o->address }}"
                                class="klik">
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->name }}</td>
                                <td>{{ $o->address }}</td>
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
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#gudang_name').val($(this).attr('data-gudang_name'));
        $('#address').val($(this).attr('data-address'));
        $('#gudang_id').val($(this).attr('data-gudang_id'));
        $('.modalGudang').modal('hide');
    });
</script>

<script>
        $('#tb-basic-table-position').DataTable({
            "pageLength": 20,
            "ordering": false
        });

</script>
@endpush
