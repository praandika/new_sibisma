<div class="modal fade modalData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">@yield('modal-title')</h5>
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
                        <!-- IF -->
                        @if(Route::is('stock.*'))
                        <thead>
                            <tr>
                                <th>Model Name</th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Model Name</th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Year</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($unit as $o)
                            <tr data-id="{{ $o->id }}" data-model="{{ $o->model_name }}"
                                data-color="{{ $o->color_name }}" data-colorcode="{{ $o->color_code }}"
                                data-yearmc="{{ $o->year_mc }}" class="klik">
                                <td>{{ $o->model_name }}</td>
                                <td>{{ $o->category }}</td>
                                <td style="background-color: <?php echo $o->color_code ?>50 ;">
                                    {{ $o->color_name }}
                                </td>
                                <td>{{ $o->year_mc }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <!-- ELSE IF -->
                        @elseif(Route::is('sale.*') || Route::is('entry.*') || Route::is('out.*') || Route::is('opname.*') || Route::is('allocation.index'))
                        
                        <thead>
                            <tr>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Year</th>
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
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($stock as $o)
                            <tr data-id="{{ $o->id }}" data-model="{{ $o->model_name }}"
                                data-color="{{ $o->color_name }}"
                                data-colorcode="{{ $o->color_code }}" data-yearmc="{{ $o->year_mc }}"
                                data-onhand="{{ $o->qty }}"
                                data-dealercode="{{ $o->dealer_code }}"
                                data-dealername="{{ $o->dealer_name }}"
                                class="klik">
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
                                <td colspan="{{ Auth::user()->access == 'master' ? '5' : '4' }}" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <!-- ELSE IF -->
                        @elseif(Route::is('allocation.out'))
                        <thead>
                            <tr>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Frame No</th>
                                <th>Engine No</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Frame No</th>
                                <th>Engine No</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($stock as $o)
                            <tr data-id="{{ $o->id }}" data-model="{{ $o->model_name }}"
                                data-color="{{ $o->color }}"
                                data-dealercode="{{ $o->dealer_code }}"
                                data-frame="{{ $o->frame_no }}"
                                data-engine="{{ $o->engine_no }}"
                                class="klik">
                                <td>{{ $o->model_name }}</td>
                                <td>{{ $o->color }}</td>
                                <td>{{ $o->frame_no }}</td>
                                <td>{{ $o->engine_no }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->access == 'master' ? '4' : '5' }}" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>

                        <!-- ELSE IF -->
                        @elseif(Route::is('document.*') || Route::is('sale-delivery.*'))
                        <thead>
                            <tr>
                                <th>Sale Date</th>
                                <th>Customer</th>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Year MC</th>
                                <th>Frame No</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sale Date</th>
                                <th>Customer</th>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Year MC</th>
                                <th>Frame No</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($sale as $o)
                            <tr data-id="{{ $o->id}}" 
                                data-customer="{{ $o->customer_name }}"
                                data-phone="{{ $o->phone }}"
                                data-address="{{ $o->address }}"
                                data-model="{{ $o->stock->unit->model_name }}"
                                data-color="{{ $o->stock->unit->color->color_name }}"
                                data-yearmc="{{ $o->stock->unit->year_mc }}"
                                data-frame="{{ $o->frame_no }}"
                                data-engine="{{ $o->engine_no }}"
                                data-colorcode="{{ $o->stock->unit->color->color_code }}"
                                class="klik">
                                <td>{{ $o->sale_date }}</td>
                                <td>{{ $o->customer_name }}</td>
                                <td>{{ $o->stock->unit->model_name }}</td>
                                <td>{{ $o->stock->unit->color->color_name }}</td>
                                <td>{{ $o->stock->unit->year_mc }}</td>
                                <td>{{ $o->frame_no }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->stock->dealer->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>

                        <!-- ELSE IF -->
                        @elseif(Route::is('branch-delivery.*'))
                        <thead>
                            <tr>
                                <th>Dealer</th>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Year</th>
                                <th>Frame No</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Dealer</th>
                                <th>Model Name</th>
                                <th>Color</th>
                                <th>Year</th>
                                <th>Frame No</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($out as $o)
                            <tr data-id="{{ $o->id}}" 
                                data-dealerid="{{ $o->dealer->dealer_id }}"
                                data-dealername="{{ $o->dealer->dealer_name }}"
                                data-phone="{{ $o->dealer->phone }}"
                                data-address="{{ $o->dealer->address }}"
                                data-model="{{ $o->stock->unit->model_name }}"
                                data-color="{{ $o->stock->unit->color->color_name }}"
                                data-yearmc="{{ $o->stock->unit->year_mc }}"
                                data-frame="{{ $o->frame_no }}"
                                data-engine="{{ $o->engine_no }}"
                                data-colorcode="{{ $o->stock->unit->color->color_code }}"
                                class="klik">
                                <td>{{ $o->dealer->dealer_name }}</td>
                                <td>{{ $o->stock->unit->color->color_name }}</td>
                                <td>{{ $o->stock->unit->model_name }}</td>
                                <td>{{ $o->frame_no }}</td>
                                <td>{{ $o->stock->unit->year_mc }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <!-- ELSE IF -->
                        @elseif(Route::is('spk.*'))
                        
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
                            <tr data-id="{{ $o->id }}" data-model="{{ $o->model_name }}"
                                data-color="{{ $o->color_name }}"
                                data-colorcode="{{ $o->color_code }}" data-yearmc="{{ $o->year_mc }}"
                                data-onhand="{{ $o->qty }}"
                                data-dealercode="{{ $o->dealer_code }}"
                                data-dealername="{{ $o->dealer_name }}"
                                data-otr="{{ number_format($o->price, 0, ',','.') }}"
                                class="klik">
                                <td>{{ $o->model_name }}</td>
                                <td style="background-color: <?php echo $o->color_code ?>50 ;">
                                    {{ $o->color_name }}
                                </td>
                                <td @if($o->qty == 0) style="background-color: maroon; color: #fff;" @endif>{{ $o->qty }}</td>
                                <td>{{ $o->year_mc }}</td>
                                <td>{{ number_format($o->price, 0, ',','.') }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->access == 'master' ? '6' : '5' }}" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>

                        <!-- ELSE -->
                        @else
                        <tbody>
                            <tr style="text-align: center;">
                                <td colspan="5" style="text-align: center;">No data available</td>
                            </tr>
                        </tbody>
                        <!-- END IF -->
                        @endif
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

@if(Route::is('stock.*'))
<script>
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#unit_id').val($(this).attr('data-id'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#year_mc').val($(this).attr('data-yearmc'));
        $('.modalData').modal('hide');
        
        $('#color_code').css('background', code);
    });
</script>
@elseif(Route::is('sale.*') || Route::is('entry.*') || Route::is('out.*') || Route::is('opname.*'))
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
        $('.modalData').modal('hide');
        
        $('#color_code').css('background', code);
    });
</script>
@elseif(Route::is('document.*') || Route::is('sale-delivery.*'))
<script>
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#sale_id').val($(this).attr('data-id'));
        $('#customer_name').val($(this).attr('data-customer'));
        $('#phone').val($(this).attr('data-phone'));
        $('#address').val($(this).attr('data-address'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#year_mc').val($(this).attr('data-yearmc'));
        $('#frame_no').val($(this).attr('data-frame'));
        $('#engine_no').val($(this).attr('data-engine'));
        $('.modalData').modal('hide');

        $('#color_code').css('background', code);
    });
</script>
@elseif(Route::is('branch-delivery.*'))
<script>
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#out_id').val($(this).attr('data-id'));
        $('#dealer_id').val($(this).attr('data-dealerid'));
        $('#dealer_name').val($(this).attr('data-dealername'));
        $('#phone').val($(this).attr('data-phone'));
        $('#address').val($(this).attr('data-address'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#year_mc').val($(this).attr('data-yearmc'));
        $('#frame_no').val($(this).attr('data-frame'));
        $('#engine_no').val($(this).attr('data-engine'));
        $('.modalData').modal('hide');

        $('#color_code').css('background', code);
    });
</script>
@elseif(Route::is('spk.*'))
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
@elseif(Route::is('allocation.index'))
<script>
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#dealer_code').val($(this).attr('data-dealercode'));
        $('#dealer').val($(this).attr('data-dealername'));
        $('.modalData').modal('hide');
        
        $('#color_code').css('background', code);
    });
</script>
@elseif(Route::is('allocation.out'))
<script>
    $(document).on('click', '.klik', function (e) {
        $('#id_allocation').val($(this).attr('data-id'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#dealer').val($(this).attr('data-dealercode'));
        $('#frame_no').val($(this).attr('data-frame'));
        $('#engine_no').val($(this).attr('data-engine'));
        $('.modalData').modal('hide');
    });
</script>
@endif

<script>
        $('#tb-basic-table-position').DataTable({
            "pageLength": 20,
            "ordering": false
        });

</script>
@endpush
