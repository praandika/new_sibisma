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
    @section('button-title','Document History')
    @include('component.button-history')
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
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
            <form action="{{ route('document.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="sale_date" type="date" class="form-control input-border-bottom"
                                name="sale_date" value="{{ Session::has('input') ? Session::get('input.sale_date') : $today }}" value="{{ old('sale_date') }}" required>
                            <label for="sale_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="sale_id" name="sale_id" value="{{ old('sale_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal"
                                data-target=".modalData" value="{{ old('model_name') }}" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Model Name *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color" value="{{ old('color') }}" style="text-transform: uppercase;" required>
                            <label for="color" class="placeholder">Color *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc" value="{{ old('year_mc') }}" style="text-transform: uppercase;" required>
                            <label for="year_mc" class="placeholder">MC Year *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="customer_name" type="text" class="form-control input-border-bottom" name="customer_name" value="{{ old('customer_name') }}" style="text-transform: uppercase;" required>
                                <label for="customer_name" class="placeholder">Customer Name *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone" value="{{ old('phone') }}" style="text-transform: uppercase;" required>
                                <label for="phone" class="placeholder">Phone Number *</label>
                        </div>
                    </div>

                    

                <div class="col-md-3">
                    <div class="form-group form-floating-label">
                        <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no" value="{{ old('frame_no') }}" style="text-transform: uppercase;" required>
                        <label for="frame_no" class="placeholder">Frame No. *</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group form-floating-label">
                        <input id="engine_no" type="text" class="form-control input-border-bottom" name="engine_no" value="{{ old('engine_no') }}" style="text-transform: uppercase;" required>
                        <label for="engine_no" class="placeholder">Engine No. *</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-floating-label">
                        <input id="address" type="text" class="form-control input-border-bottom" name="address" value="{{ old('address') }}"
                        style="text-transform: uppercase;" required>
                            <label for="address" class="placeholder">Address *</label>
                    </div>
                </div> 
            </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="stck" type="text" class="form-control input-border-bottom" name="stck" value="{{ old('stck') }}"
                                placeholder="Nomor STCK" style="text-transform: uppercase;">
                            <label for="stck" class="placeholder"></label>
                        </div>
                    </div> 


                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="stnk" type="text" class="form-control input-border-bottom" name="stnk" value="{{ old('stnk') }}"
                                placeholder="Nomor STNK" style="text-transform: uppercase;">
                            <label for="stnk" class="placeholder"></label>
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="bpkb" type="text" class="form-control input-border-bottom" name="bpkb" value="{{ old('bpkb') }}"
                                placeholder="Nomor BPKB" style="text-transform: uppercase;">
                            <label for="bpkb" class="placeholder"></label>
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="document_note" type="text" class="form-control input-border-bottom" name="document_note" value="{{ old('document_note') }}"
                                placeholder="Document Note" style="text-transform: uppercase;">
                            <label for="document_note" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Sale')
@include('component.modal-data')


@push('after-script')
<script>
    $(document).ready(function(){
        $('form').submit(function(e){
            let onHand = $('#on_hand').val();
            let stock = onHand - 1;
            console.log(onHand);
            console.log(stock);
            if (stock < 0) {
                e.preventDefault();
                $('#on_hand').addClass('is-invalid');
                $('#error-msg').text('out of stock!');
            } else {
                $('form').submit();
            }
        });
    });

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
