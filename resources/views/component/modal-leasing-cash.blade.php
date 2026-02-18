<div class="modal fade modalLeasingCash" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Microfinance / Instansi</h5>
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
                                <th>Microfinance Code</th>
                                <th>Microfinance Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Microfinance Code</th>
                                <th>Microfinance Name</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($microfinance as $o)
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
        $('#leasing_id_cash').val($(this).attr('data-id'));
        $('#leasing_code_cash').val($(this).attr('data-code'));
        $('.modalLeasingCash').modal('hide');
    });
</script>
@endpush
