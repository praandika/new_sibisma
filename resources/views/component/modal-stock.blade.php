<div class="modal fade modalData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data Stock</h5>
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
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Year</th>
                                <th>OTR</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Year</th>
                                <th>OTR</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($stock as $o)
                            <tr data-id="{{ $o->id }}" data-model="{{ $o->unit->model_name }}"
                                data-color="{{ $o->unit->color->color_name }}"
                                data-colorcode="{{ $o->unit->color->color_code }}" data-yearmc="{{ $o->unit->year_mc }}"
                                data-onhand="{{ $o->qty }}"
                                data-dealercode="{{ $o->dealer->dealer_code }}"
                                data-dealername="{{ $o->dealer->dealer_name }}"
                                data-otr="{{ number_format($o->unit->price, 0, ',','.') }}"
                                class="klik">
                                <td>{{ $o->unit->model_name }}</td>
                                <td style="background-color: <?php echo $o->unit->color->color_code ?>50 ;">
                                    {{ $o->unit->color->color_name }}
                                </td>
                                <td @if($o->qty == 0) style="background-color: maroon; color: #fff;" @endif>{{ $o->qty }}</td>
                                <td>{{ $o->unit->year_mc }}</td>
                                <td>{{ number_format($o->unit->price, 0, ',','.') }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->access == 'master' ? '6' : '5' }}" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#stock_id').val($(this).attr('data-id'));
        $('#model_name').val($(this).attr('data-model'));
        $('#on_hand').val($(this).attr('data-onhand'));
        $('#dealer_code').val($(this).attr('data-dealercode'));
        $('#dealer').val($(this).attr('data-dealername'));
        $('#otr').val($(this).attr('data-otr'));
        $('.modalData').modal('hide');
        
        $('#color_code').css('background', code);
    });
</script>

<script>
        $('#tb-basic-table-position').DataTable({
            "pageLength": 20,
            "ordering": false
        });

</script>
@endpush
