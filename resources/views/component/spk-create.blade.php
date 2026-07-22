@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }

    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }

    ::-webkit-input-placeholder {
        /* WebKit browsers */
        text-transform: none;
    }

    :-moz-placeholder {
        /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }

    ::-moz-placeholder {
        /* Mozilla Firefox 19+ */
        text-transform: none;
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10+ */
        text-transform: none;
    }

    ::placeholder {
        /* Recent browsers */
        text-transform: none;
    }

    .leasing-group {
        background-color: #c6ebf5;
    }

</style>
@endpush

@push('button')
    @section('button-title','SPK History')
    @include('component.button-history')

    <button class="btn btn-success btn-round" id="btnCreate" @if(Session::has('display'))
        style="margin-bottom: 20px; display: none;" @else style="margin-bottom: 20px; display: block;" @endif><i
            class="fa fa-pencil-alt"></i>&nbsp;&nbsp; <strong>Create SPK</strong> </button>
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;"
    @endif>
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
                <div class="col-10">
                    <h4 class="card-title">Create SPK | {{ $spk_no }}</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('spk.store') }}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row" style="background-color: #fff1cf; padding-top: 10px; border-radius: 10px;">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="payment_method" type="text" class="form-control input-border-bottom"
                                name="payment_method" value="{{ old('payment_method') }}" data-toggle="modal"
                                data-target=".modalPaymentMethod" style="text-transform: capitalize;" required>
                            <label for="payment_method" class="placeholder">Choose Payment Method *</label>
                        </div>
                    </div>
                    <div class="col-md-4" id="col-credit-status">
                        <div class="form-group form-floating-label">
                            <input id="credit_status" type="text" class="form-control input-border-bottom"
                                name="credit_status" value="{{ old('credit_status') }}" data-toggle="modal"
                                data-target=".modalCreditStatus" style="text-transform: capitalize;">
                            <label for="credit_status" class="placeholder"><span id="place">Choose Credit Status
                                    *</span></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="order_status" type="text" class="form-control input-border-bottom"
                                name="order_status" value="{{ old('order_status') }}" data-toggle="modal"
                                data-target=".modalOrderStatus" style="text-transform: capitalize;" required>
                            <label for="order_status" class="placeholder">Choose Order Status *</label>
                        </div>
                    </div>
                </div>

                <br>
                <div style="border: 1px dashed grey;"></div>
                <br>

                <input type="hidden" name="spk_no" value="{{ $spk_no }}" required>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="spk_date" type="date" class="form-control input-border-bottom" name="spk_date"
                                value="{{ $today }}" required readonly>
                            <!-- <label for="spk_date" class="placeholder">Date *</label> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="order_name" type="text" class="form-control input-border-bottom"
                                name="order_name" value="{{ old('order_name') }}" style="text-transform: uppercase;" required>
                            <label for="order_name" class="placeholder">Customer's Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ old('address') }}" style="text-transform: uppercase" required maxlength="100">
                            <label for="address" class="placeholder">KTP Address</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address_shipment" type="text" class="form-control input-border-bottom" name="address_shipment"
                                value="{{ old('address_shipment') }}" style="text-transform: uppercase" required maxlength="100">
                            <label for="address_shipment" class="placeholder">Pengiriman Address</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="ktp_number" type="number" class="form-control input-border-bottom" name="ktp_number"
                                value="{{ old('ktp_number') }}" style="text-transform: uppercase" required maxlength="16">
                            <label for="ktp_number" class="placeholder">KTP Number</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="kk_number" type="number" class="form-control input-border-bottom" name="kk_number"
                                value="{{ old('kk_number') }}" style="text-transform: uppercase" maxlength="16">
                            <label for="kk_number" class="placeholder">KK Number</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="number" class="form-control input-border-bottom" name="phone"
                                value="{{ old('phone') }}" required>
                            <label for="phone" class="placeholder">Customer's Phone</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="stnk_name" type="text" class="form-control input-border-bottom" name="stnk_name"
                                value="{{ old('stnk_name') }}" style="text-transform: uppercase" required>
                            <label for="stnk_name" class="placeholder">STNK Name</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" value="{{ old('stock_id') }}" required>
                            <input id="on_hand" type="hidden" class="form-control input-border-bottom" name="on_hand"
                                value="{{ old('on_hand') }}">

                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal" data-target=".modalData"
                                value="{{ old('model_name') }}" required>
                            <label for="model_name" class="placeholder">Select Unit *</label>

                            <span class="invalid-feedback">
                                <strong><span id="error-msg"></span></strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="otr" type="text" class="form-control input-border-bottom" name="otr"
                                value="{{ old('otr') }}" required>
                            <label for="otr" class="placeholder">OTR Price</label>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="tandajadi" type="number" class="form-control input-border-bottom" name="tandajadi"
                                value="{{ old('tandajadi') }}" required>
                            <label for="tandajadi" class="placeholder">Tanda Jadi</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="downpayment" type="number" class="form-control input-border-bottom"
                                name="downpayment" value="{{ old('downpayment') }}" required>
                            <label for="downpayment" class="placeholder">Down Payment</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="discount" type="number" class="form-control input-border-bottom" name="discount"
                                value="{{ old('discount') }}" required>
                            <label for="discount" class="placeholder">Discount</label>
                        </div>
                    </div>

                    <!-- <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="payment" type="number" class="form-control input-border-bottom" name="payment"
                                value="{{ old('payment') }}" required>
                            <label for="payment" class="placeholder">Payment</label>
                        </div>
                    </div> -->

                    <div class="col-md-3 leasing-group" id="col-leasing" hidden>
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="leasing_id" name="leasing_id" value="{{ old('leasing_id') }}"
                                >
                            <input id="leasing_code" type="text" class="form-control input-border-bottom"
                                name="leasing_code" value="{{ old('leasing_code') }}" data-toggle="modal">
                            <label for="leasing_code" class="placeholder">Select Finance *</label>
                        </div>
                    </div>

                    <div class="col-md-3 leasing-group" id="col-leasing-bunga">
                        <div class="form-group form-floating-label">
                            <input id="bunga" type="text" class="form-control input-border-bottom" name="bunga"
                                value="{{ old('bunga') }}" data-toggle="modal" data-target=".modalBunga">
                            <label for="bunga" class="placeholder">Bunga *</label>
                        </div>
                    </div>

                    <div class="col-md-3 leasing-group" id="col-leasing-tenor">
                        <div class="form-group form-floating-label">
                            <input id="tenor" type="text" class="form-control input-border-bottom" name="tenor"
                                value="{{ old('tenor') }}" data-toggle="modal" data-target=".modalTenor">
                            <label for="tenor" class="placeholder">Tenor *</label>
                        </div>
                    </div>

                    <div class="col-md-3 leasing-group" id="col-leasing-namapemohon">
                        <div class="form-group form-floating-label">
                            <input id="pemohon_name" type="text" class="form-control input-border-bottom" name="pemohon_name"
                                value="{{ old('pemohon_name') }}" style="text-transform: uppercase">
                            <label for="pemohon_name" class="placeholder">Nama Pemohon</label>
                        </div>
                    </div>

                    <div class="col-md-3" id="col-leasing-cash" hidden>
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="leasing_id_cash" name="leasing_id_cash" value="{{ old('leasing_id_cash') }}"
                                >
                            <input id="leasing_code_cash" type="text" class="form-control input-border-bottom"
                                name="leasing_code" value="{{ old('leasing_code') }}" data-toggle="modal">
                            <label for="leasing_code_cash" class="placeholder">Select Micro/Instansi *</label>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                                <input type="hidden" id="manpower_id" name="manpower_id" value="{{ old('manpower_id') }}"
                                    required>
                                <input id="manpower" type="text" class="form-control input-border-bottom" name="manpower"
                                    value="{{ old('manpower') }}" data-toggle="modal" data-target=".modalManpower" required>
                                <label for="manpower" class="placeholder">Select Manpower *</label>
                            
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-top: 12px;">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#uploadKtp" aria-expanded="false" aria-controls="uploadKtp" style="font-weight: bold;">
                            Upload / Take an ID-KTP photo
                        </button>
                        <div class="collapse" id="uploadKtp">
                            <div class="card card-body">
                                <div class="form-group form-floating-label">
                                    <input id="picture" type="file" class="form-control input-border-bottom" name="picture"
                                        value="{{ old('picture') }}">
                                    <label for="picture" class="placeholder" style="
                                background-color: forestgreen; 
                                color: #ffffff !important; 
                                font-weight: bold;
                                width: 200px; 
                                padding-left: 20px; 
                                padding-right: 20px;
                                padding-top: 10px; 
                                border-radius: 5px;
                                position: absolute;
                                top: 20px;
                                cursor: pointer;"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload File</label>
                                </div>

                                <div class="form-group form-floating-label" style="position: relative;">
                                    <input id="photo" type="file" accept="image/*" capture="user"
                                        class="form-control input-border-bottom" name="photo"
                                        value="{{ old('photo') }}">
                                    <label for="photo" class="placeholder" style="
                                background-color: teal; 
                                color: #ffffff !important; 
                                font-weight: bold;
                                width: 200px; 
                                padding-left: 20px; 
                                padding-right: 20px;
                                padding-top: 10px; 
                                border-radius: 5px;
                                position: absolute;
                                top: 20px;
                                cursor: pointer;"><i class="fa fa-camera"></i>&nbsp;&nbsp;Take a Photo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea name="description" id="description" cols="30" rows="10" maxlength="100"
                                class="form-control input-border-bottom" placeholder="Description"
                                value="{{ old('description') }}"
                                style="border: 1px dashed #e6e6e6; padding: 10px; text-transform: uppercase;"></textarea>
                            <label for="description" class="placeholder"></label>
                        </div>
                    </div>


                    </div>
                    @if(Auth::user()->dealer_code == 'group')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-floating-label">
                                <input type="hidden" id="dealer_code" name="dealer_code"
                                    value="{{ old('dealer_code') }}" required>
                                <input id="dealer" type="text" class="form-control input-border-bottom" name="dealer"
                                    value="{{ old('dealer') }}" required>
                                <label for="dealer" class="placeholder">Dealer *</label>
                            </div>
                        </div>
                    </div>
                    @else
                    <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $dealerCode }}" required>
                    @endif

                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                    <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Stock')
@include('component.modal-data')
@include('component.modal-leasing')
@include('component.modal-leasing-cash')
@include('component.modal-manpower')
@include('component.modal-payment-method')
@include('component.modal-credit-status')
@include('component.modal-order-status')
@include('component.modal-tenor')
@include('component.modal-bunga')

@push('after-script')
<script>
    // $(document).ready(function(){
    //     $('#form').submit(function(e){
    //         let onHand = $('#on_hand').val();
    //         let stock = onHand - 1;
    //         console.log(onHand);
    //         console.log(stock);
    //         if (stock < 0) {
    //             e.preventDefault();
    //             $('#on_hand').addClass('is-invalid');
    //             $('#error-msg').text('out of stock!');
    //         } else {
    //             $('#form').submit();
    //         }
    //     });
    // });

    $('#on_hand').keypress(function (e) {
        e.preventDefault();
    });

    $('#on_hand').keydown(function (e) {
        e.preventDefault();
    });

    // document.addEventListener('contextmenu', function(e){
    //     e.preventDefault();
    // });
    $(document).ready(function () {
        $('#btnCreate').click(function () {
            $(this).css('display', 'none');
            $('#dataCreate').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataCreate').css('display', 'none');
            $('#btnCreate').fadeIn();
        });
    });

    function setAttributes(el, attrs) {
        for(var key in attrs) {
            el.setAttribute(key, attrs[key]);
        }
    }

    function removeAttributes(el, attrs) {
        for(var key in attrs) {
            el.removeAttribute(key, attrs[key]);
        }
    }

    function showLeasingGroup() {

        let payment_method = $('#payment_method').val().toLowerCase();

        if (payment_method === 'credit') {
            $('#col-leasing-bunga').removeAttr('hidden');
            $('#col-leasing-tenor').removeAttr('hidden');
            $('#col-leasing-namapemohon').removeAttr('hidden');
            $('#col-credit-status').removeAttr('hidden');
            $('#col-leasing').removeAttr('hidden');
            $('#col-leasing-cash').attr('hidden', true);
            $('#credit_status').attr('required', true);
            $('#leasing_code').attr('required', true);
            $('#leasing_code_cash').removeAttr('required');
            $('#bunga').attr('required', true);
            $('#tenor').attr('required', true);
            $('#pemohon_name').attr('required', true);
            $('#leasing_id').attr('required', true);
            $('#leasing_id_cash').removeAttr('required');
            $('#leasing_code').attr('data-target', '.modalLeasing');
            $('#leasing_code').val('');
        } else {
            $('#col-leasing-bunga').attr('hidden', true);
            $('#col-leasing-tenor').attr('hidden', true);
            $('#col-leasing-namapemohon').attr('hidden', true);
            $('#col-credit-status').attr('hidden', true);
            $('#col-leasing-cash').removeAttr('hidden');
            $('#col-leasing').attr('hidden', true);
            $('#credit_status').removeAttr('required');
            $('#leasing_code').removeAttr('required');
            $('#leasing_code_cash').attr('required', true);
            $('#bunga').removeAttr('required');
            $('#tenor').removeAttr('required');
            $('#pemohon_name').removeAttr('required');
            $('#leasing_id').removeAttr('required');
            $('#leasing_id_cash').attr('required', true);
            $('#leasing_code_cash').attr('data-target', '.modalLeasingCash');
            $('#leasing_code_cash').val('');
        }

    }

    // Custom Upload File
    $(document).ready(function () {
        $("#picture").change(function () {
            filename = this.picture[0].name;
            console.log(filename);
        });
    });

    // Custom Upload File
    $(document).ready(function () {
        $("#photo").change(function () {
            filename = this.photo[0].name;
            console.log(filename);
        });
    });
</script>
@endpush
