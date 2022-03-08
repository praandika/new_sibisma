@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }
    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }
    ::-webkit-input-placeholder { /* WebKit browsers */
        text-transform: none;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        text-transform: none;
    }
    :-ms-input-placeholder { /* Internet Explorer 10+ */
        text-transform: none;
    }
    ::placeholder { /* Recent browsers */
        text-transform: none;
    }
</style>
@endpush

@push('button')
    @section('button-title','Sales History')
    @include('component.button-history')
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
        <livewire:widget-stock-qty>
            <span id="color_code" style="
                width: 10px; height: 50%; 
                display: inline-block;
                position: absolute;
                left: 0px;
                top: 0px;">
            </span>
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Add Sales</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sale.simple-store') }}" method="post" id="form">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="sale_date" type="date" class="form-control input-border-bottom"
                                name="sale_date" value="{{ old('sale_date') }}" style="text-transform: uppercase;" required>
                            <label for="sale_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" value="{{ old('stock_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal"
                                data-target=".modalData" value="{{ old('model_name') }}" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Stock *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color" value="{{ old('color') }}"
                                placeholder="Color *" style="text-transform: uppercase;">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc" value="{{ old('year_mc') }}"
                                placeholder="Year MC *" style="text-transform: uppercase;">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="on_hand" type="text" class="form-control input-border-bottom" name="on_hand" value="{{ old('on_hand') }}"
                                placeholder="Stock On Hand *" style="text-transform: uppercase;" readonly>
                            <label for="on_hand" class="placeholder"></label>

                            <span class="invalid-feedback">
                                <strong><span id="error-msg"></span></strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="leasing_id" name="leasing_id" value="{{ old('leasing_id') }}" required>
                            <input id="leasing_code" type="text" class="form-control input-border-bottom"
                                name="leasing_code" value="{{ old('leasing_code') }}" data-toggle="modal"
                                data-target=".modalLeasing" style="text-transform: uppercase;" required>
                            <label for="leasing_code" class="placeholder">Select Leasing *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="sale_qty" type="number" class="form-control input-border-bottom" name="sale_qty" value="{{ old('sale_qty') }}" style="text-transform: uppercase;" required>
                            <label for="sale_qty" class="placeholder">Qty*</label>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->dealer_code == 'group')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ old('dealer_code') }}" required>
                            <input id="dealer" type="text" class="form-control input-border-bottom"
                                name="dealer" value="{{ old('dealer') }}" style="text-transform: uppercase;" required>
                            <label for="dealer" class="placeholder">Dealer *</label>
                        </div>
                    </div>
                </div>
                @else
                <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $dealerCode }}" style="text-transform: uppercase;" required>
                @endif

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Stock')
@include('component.modal-data')
<livewire:modal-leasing/>
<livewire:modal-dealer/>

@push('after-script')
<script>
    $(document).ready(function(){
        $('#form').submit(function(e){
            let onHand = $('#on_hand').val();
            let stock = onHand - 1;
            console.log(onHand);
            console.log(stock);
            if (stock < 0) {
                e.preventDefault();
                $('#on_hand').addClass('is-invalid');
                $('#error-msg').text('out of stock!');
            } else {
                $('#form').submit();
            }
        });
    });

    $('#on_hand').keypress(function(e){
        e.preventDefault();
    });

    $('#on_hand').keydown(function(e){
        e.preventDefault();
    });

    // document.addEventListener('contextmenu', function(e){
    //     e.preventDefault();
    // });
</script>
@endpush
