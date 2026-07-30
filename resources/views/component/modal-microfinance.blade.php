<div class="modal fade modalMicrofinance" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Microfinance</h5>
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
                                <th>Microfinance / Instansi</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Microfinance / Instansi</th>
                                <th>Category</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($microfinance as $o)
                            <tr data-id="{{ $o->id }}" data-code="{{ $o->leasing_code }}" class="pilihMicrofinance">
                                <td>
                                    <div class="td-group">
                                        <span class="main-data">{{ $o->leasing_code }}</span>
                                        <span class="secondary-data">
                                            <div style="font-size: 11px; font-weight: bold; font-style: italic;" class="mt-2">{{ $o->leasing_name }}</div>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    {{ $o->leasing_category }}
                                </td>
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
    $(document).on('click', '.pilihMicrofinance', function (e) {
        $('#microfinance').val($(this).attr('data-code'));
        $('.modalMicrofinance').modal('hide');
    });
</script>
@endpush
