<div class="modal fade modalSPK" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data SPK</h5>
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
                                <th>SPK</th>
                                <th>Customer</th>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>Year</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SPK</th>
                                <th>Customer</th>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>Year</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($stock as $o)
                            <tr data-spk="{{ $o->spk_no }}"
                                data-spk_id="{{ $o->idspk }}"
                                data-name="{{ $o->stnk_name }}"
                                data-phone="{{ $o->phone }}"
                                data-leasing_id="{{ $o->leasing_id }}"
                                data-leasing="{{ $o->leasing_code }}"
                                data-address="{{ $o->address }}"
                                data-id="{{ $o->idstok }}" 
                                data-model="{{ $o->model_name }}"
                                data-color="{{ $o->color_name }}"
                                data-colorcode="{{ $o->color_code }}" 
                                data-yearmc="{{ $o->year_mc }}"
                                data-onhand="{{ $o->qty }}"
                                data-dealercode="{{ $o->dealer_code }}"
                                data-dealername="{{ $o->dealer_name }}"
                                class="klik">
                                <td>
                                    @if($o->payment_method == 'credit')
                                    <span style="position: relative;">
                                        <span style="
                                        width: 50px; 
                                        height: 12px; 
                                        background-color: #fff1cf; 
                                        display: inline-block; 
                                        position: absolute; 
                                        top: -20px; 
                                        left: -25px; 
                                        border-radius: 0 0 0 0;">
                                        <span style="font-size: 10px; font-weight: bold; position: relative; color: #b87c04; top: -7px; left: 5px;">
                                            credit
                                        </span>
                                    </span>
                                    @else
                                    <span style="position: relative;">
                                        <span style="
                                        width: 50px; 
                                        height: 12px; 
                                        background-color: #cfe4ff; 
                                        display: inline-block; 
                                        position: absolute; 
                                        top: -20px; 
                                        left: -25px; 
                                        border-radius: 0 0 0 0;">
                                        <span style="font-size: 10px; font-weight: bold; position: relative; color: #0258c2; top: -7px; left: 5px;">
                                            cash 
                                        </span>
                                    </span>
                                    @endif

                                    <span style="position: relative;">
                                        <span style="
                                        width: 52px; 
                                        height: 12px; 
                                        background-color: #daf2ef; 
                                        display: inline-block; 
                                        position: absolute; 
                                        top: -20px; 
                                        left: 25px; 
                                        border-radius: 0 0 0 0;">
                                        <span style="font-size: 10px; font-weight: bold; position: relative; color: #036657; top: -7px; left: 5px;">
                                            {{ $o->order_status }} 
                                        </span>
                                    </span>

                                    <span style="position: relative;">
                                        <span style="
                                        width: 52px; 
                                        height: 12px; 
                                        background-color: #c4d9c1;
                                        display: inline-block; 
                                        position: absolute; 
                                        top: -20px; 
                                        left: 75px; 
                                        border-radius: 0 0 15px 0;">
                                        <span style="font-size: 10px; font-weight: bold; position: relative; color: #0d5201; top: -7px; left: 5px;">
                                            {{ $o->credit_status }} 
                                        </span>
                                    </span>
                                        <span>
                                            {{ $o->spk_no }}
                                        </span>
                                    </span>
                                </td>
                                <td>{{ $o->order_name }}</td>
                                <td>{{ $o->model_name }}</td>
                                <td style="background-color: <?php echo $o->color_code ?>50 ;">
                                    {{ $o->color_name }}
                                </td>
                                <td @if($o->qty == 0) style="background-color: maroon; color: #fff;" @endif>{{ $o->qty }}</td>
                                <td>{{ $o->year_mc }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->access == 'master' ? '7' : '6' }}" style="text-align: center;">No data available</td>
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
        $('#stock_id').val($(this).attr('data-id'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#year_mc').val($(this).attr('data-yearmc'));
        $('#on_hand').val($(this).attr('data-onhand'));
        $('#dealer_code').val($(this).attr('data-dealercode'));
        $('#dealer').val($(this).attr('data-dealername'));
        $('#spk_no').val($(this).attr('data-spk'));
        $('#spk').val($(this).attr('data-spk'));
        $('#spk_id').val($(this).attr('data-spk_id'));
        $('#customer_name').val($(this).attr('data-name'));
        $('#phone').val($(this).attr('data-phone'));
        $('#leasing_id').val($(this).attr('data-leasing_id'));
        $('#leasing_code').val($(this).attr('data-leasing'));
        $('#address').val($(this).attr('data-address'));
        $('.modalSPK').modal('hide');
        
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
