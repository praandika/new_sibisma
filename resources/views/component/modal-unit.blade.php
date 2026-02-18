<div class="modal fade modalUnit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <table id="basic-datatables-unit" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Unit</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($unitData as $o)
                            <tr data-id="{{ $o->id }}" data-unit="{{ $o->model_name }}" class="pilihUnit">
                                <td>{{ $o->model_name }}</td>
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
    $(document).on('click', '.pilihUnit', function (e) {
        $('#unit').val($(this).attr('data-id'));
        $('#unitName').val($(this).attr('data-unit'));
        $('.modalUnit').modal('hide');
    });

    $(document).ready(function () {
        $('#basic-datatables-unit').DataTable({
            "pageLength": 20
        });
    });
</script>
@endpush
