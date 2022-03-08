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
    @section('button-title','Stock Opname History')
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
                    <h4 class="card-title">Add Stock Opname</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('opname.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="opname_date" type="date" class="form-control input-border-bottom"
                                name="opname_date" value="{{ Session::has('input') ? Session::get('input.opname_date') : $today }}" value="{{ old('opname_date') }}" required>
                            <label for="opname_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" value="{{ old('stock_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal"
                                data-target=".modalData" value="{{ old('model_name') }}" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Stock *</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color" value="{{ old('color') }}"
                                placeholder="Color *" style="text-transform: uppercase;">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc" value="{{ old('year_mc') }}"
                                placeholder="Year MC *" style="text-transform: uppercase;">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="on_hand" type="text" class="form-control input-border-bottom" name="on_hand" value="{{ old('on_hand') }}"
                                placeholder="Stock On Hand *" style="text-transform: uppercase;" readonly>
                            <label for="on_hand" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="stock_opname" type="number" class="form-control input-border-bottom" name="stock_opname" value="{{ old('stock_opname') }}"
                                placeholder="Adjust Stock *" style="text-transform: uppercase;" required>
                            <label for="stock_opname" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Stock')
@include('component.modal-data')

@push('after-script')
<script>

    $('#on_hand').keypress(function(e){
        e.preventDefault();
    });

    $('#on_hand').keydown(function(e){
        e.preventDefault();
    });

    document.addEventListener('contextmenu', function(e){
        e.preventDefault();
    });
</script>
@endpush
