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
@section('button-title','Entry History')
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
                        <h4 class="card-title">Add Entry</h4>
                    </div>
                </div>
        </div>
        <div class="card-body">
            <form action="{{ route('entry.store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="entry_date" type="date" class="form-control input-border-bottom"
                                name="entry_date" value="{{ old('entry_date') }}" style="text-transform: uppercase;" required>
                            <label for="entry_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" value="{{ old('stock_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal" data-target=".modalData"
                                value="{{ old('model_name') }}" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Stock *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                                value="{{ old('color') }}" placeholder="Color *" style="text-transform: uppercase;">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                value="{{ old('year_mc') }}" placeholder="Year MC *" style="text-transform: uppercase;">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="on_hand" type="text" class="form-control input-border-bottom" name="on_hand"
                                value="{{ old('on_hand') }}" placeholder="Stock On Hand *" style="text-transform: uppercase;" readonly>
                            <label for="on_hand" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ old('dealer_id') }}"
                                required>
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ old('dealer_name') }}" data-toggle="modal"
                                data-target=".modalDealer" style="text-transform: uppercase;" required>
                            <label for="dealer_name" class="placeholder">Select Sender *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="in_qty" type="number" class="form-control input-border-bottom" name="in_qty"
                                value="{{ old('in_qty') }}" style="text-transform: uppercase;" required>
                            <label for="in_qty" class="placeholder" required>Qty *</label>
                        </div>
                    </div>

                    @if(Auth::user()->dealer_code == 'group')
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ old('dealer_code') }}"
                                required>
                            <input id="dealer" type="text" class="form-control input-border-bottom" name="dealer"
                                value="{{ old('dealer') }}"
                                style="text-transform: uppercase;" required>
                            <label for="dealer" class="placeholder">Dealer *</label>
                        </div>
                    </div>
                    @else
                    <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $dealerCode }}" style="text-transform: uppercase;" required>
                    @endif
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Stock')
@include('component.modal-data')
<livewire:modal-dealer/>

@push('after-script')
<script>
    $('#on_hand').keypress(function (e) {
        e.preventDefault();
    });

    $('#on_hand').keydown(function (e) {
        e.preventDefault();
    });

    // document.addEventListener('contextmenu', function (e) {
    //     e.preventDefault();
    // });

</script>
@endpush
