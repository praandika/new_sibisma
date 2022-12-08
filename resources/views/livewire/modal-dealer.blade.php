<div class="modal fade modalDealer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            @if(Route::is('user.*'))
                                <tr data-code="group" data-name="Bisma Group" class="pilihDealer">
                                    <td style="text-align: center;" colspan="3">Bisma Group</td>
                                </tr>
                                @forelse($dealer as $o)
                                <tr data-code="{{ $o->dealer_code }}" data-name="{{ $o->dealer_name }}" class="pilihDealer" style="background-color: <?php echo $o->dealer_code == 'YIMM' ? '#297bff50' : '' ?>;">
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->dealer_code }}</td>
                                    <td>{{ $o->dealer_name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" style="text-align: center;">No data available</td>
                                </tr>
                                @endforelse
                            @elseif(Route::is('out.*') || Route::is('report.adjust'))
                                @forelse($dealerOut as $o)
                                <tr data-id="{{ $o->id }}" data-code="{{ $o->dealer_code }}" data-name="{{ $o->dealer_name }}" class="pilihDealer" style="background-color: <?php echo $o->dealer_code == 'YIMM' ? '#297bff50' : '' ?>;">
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->dealer_code }}</td>
                                    <td>{{ $o->dealer_name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" style="text-align: center;">No data available</td>
                                </tr>
                                @endforelse
                            @else
                                @forelse($dealer as $o)
                                <tr data-id="{{ $o->id }}" data-code="{{ $o->dealer_code }}" data-name="{{ $o->dealer_name }}" class="pilihDealer" style="background-color: <?php echo $o->dealer_code == 'YIMM' ? '#297bff50' : '' ?>;">
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->dealer_code }}</td>
                                    <td>{{ $o->dealer_name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" style="text-align: center;">No data available</td>
                                </tr>
                                @endforelse
                            @endif
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
    @if(Route::is('user.*') || Route::is('report.adjust'))
    <script>
        $(document).on('click', '.pilihDealer', function (e) {
            $('#dealer_code').val($(this).attr('data-code'));
            $('#dealer_name').val($(this).attr('data-name'));
            $('.modalDealer').modal('hide');
        });
    </script>
    @else
    <script>
        $(document).on('click', '.pilihDealer', function (e) {
            $('#dealer_id').val($(this).attr('data-id'));
            $('#dealer_name').val($(this).attr('data-name'));
            $('.modalDealer').modal('hide');
        });
    </script>
    @endif
@endpush
