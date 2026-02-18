<div class="modal fade modalMasterDealer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Dealer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($dealer as $o)
                            <tr data-id="{{ $o->id }}" data-code="{{ $o->dealer_code }}"
                                data-name="{{ $o->dealer_name }}" class="pilihMasterDealer"
                                style="background-color: <?php echo $o->dealer_code == 'YIMM' ? '#297bff50' : '' ?>;">
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->dealer_code }}</td>
                                <td>{{ $o->dealer_name }}</td>
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
    $(document).on('click', '.pilihMasterDealer', function (e) {
        $('#dealer_code').val($(this).attr('data-code'));
        $('#dealer').val($(this).attr('data-name'));
        $('.modalMasterDealer').modal('hide');
    });

</script>
@endpush
