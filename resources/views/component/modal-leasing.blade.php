<div class="modal fade modalLeasing" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Leasing</h5>
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
                                <th>Leasing Code</th>
                                <th>Leasing Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Leasing Code</th>
                                <th>Leasing Name</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($leasing as $o)
                            <tr data-id="{{ $o->id }}" data-code="{{ $o->leasing_code }}" class="pilihLeasing">
                                <td>{{ $o->leasing_code }}</td>
                                <td>{{ $o->leasing_name }}</td>
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
            @include('component.modal-footer')
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.pilihLeasing', function (e) {
        $('#leasing_id').val($(this).attr('data-id'));
        $('#leasing_code').val($(this).attr('data-code'));
        $('.modalLeasing').modal('hide');
    });
</script>
@endpush
