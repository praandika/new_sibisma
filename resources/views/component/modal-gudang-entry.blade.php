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
                                <th>Gudang</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Gudang</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($gudang as $o)
                            <tr data-gudang="{{ $o->name }}"
                                class="klik">
                                <td>{{ $o->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="1" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
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
    $(document).on('click', '.klik', function (e) {
        $('#gudang').val($(this).attr('data-gudang'));
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
