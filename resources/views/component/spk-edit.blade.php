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

@section('title','Edit SPK')
@section('page-title','SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">Data SPK</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
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
                <h4 class="card-title">Edit SPK | {{ $spk->spk_no }}</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('spk.update', $spk->id) }}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" style="background-color: #fff1cf; padding-top: 10px; border-radius: 10px;">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="payment_method" type="text" class="form-control input-border-bottom"
                                name="payment_method" value="{{ $spk->payment_method }}" data-toggle="modal"
                                data-target=".modalPaymentMethod" style="text-transform: capitalize;" required>
                            <label for="payment_method" class="placeholder">Choose Payment Method *</label>
                        </div>
                    </div>
                    <div class="col-md-4" id="col-credit-status">
                        <div class="form-group form-floating-label">
                            <input id="credit_status" type="text" class="form-control input-border-bottom"
                                name="credit_status" value="{{ $spk->credit_status }}" data-toggle="modal"
                                data-target=".modalCreditStatus" style="text-transform: capitalize;" required>
                            <label for="credit_status" class="placeholder"><span id="place">Choose Credit Status *</span></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="order_status" type="text" class="form-control input-border-bottom"
                                name="order_status" value="{{ $spk->order_status }}" data-toggle="modal"
                                data-target=".modalOrderStatus" style="text-transform: capitalize;" required>
                            <label for="order_status" class="placeholder">Choose Order Status *</label>
                        </div>
                    </div>
                </div>

                <br>
                <div style="border: 1px dashed grey;"></div>
                <br>

                <input type="hidden" name="spk_no" value="{{ $spk->spk_no }}" required>
                <input type="hidden" name="sale_status" value="{{ $spk->sale_status }}" required>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="spk_date" type="date" class="form-control input-border-bottom"
                                name="spk_date" value="{{ $spk->spk_date }}" required>
                            <label for="spk_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="order_name" type="text" class="form-control input-border-bottom" name="order_name" value="{{ $spk->order_name }}" style="text-transform: uppercase;" required>
                            <label for="order_name" class="placeholder">Customer's Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address" value="{{ $spk->address }}" style="text-transform: uppercase;" required>
                            <label for="address" class="placeholder">Customer's Address</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="number" class="form-control input-border-bottom" name="phone" value="{{ $spk->spk_phone }}" required>
                            <label for="phone" class="placeholder">Customer's Phone</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="stnk_name" type="text" class="form-control input-border-bottom" name="stnk_name" value="{{ $spk->stnk_name }}" style="text-transform: uppercase;" required>
                            <label for="stnk_name" class="placeholder">STNK Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" value="{{ $spk->stock_id }}" required>
                            <input id="on_hand" type="hidden" class="form-control input-border-bottom" name="on_hand" value="{{ $spk->stock->qty }}">

                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal"
                                data-target=".modalData" value="{{ $spk->stock->unit->model_name }}" required>
                            <label for="model_name" class="placeholder">Select Unit *</label>

                            <span class="invalid-feedback">
                                <strong><span id="error-msg"></span></strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="otr" type="text" class="form-control input-border-bottom" name="otr" value="{{ $spk->stock->unit->price }}" required>
                            <label for="otr" class="placeholder">OTR Price</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="tandajadi" type="number" class="form-control input-border-bottom" name="tandajadi"
                                value="{{ $spk->tandajadi }}" required>
                            <label for="tandajadi" class="placeholder">Tanda Jadi</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="downpayment" type="number" class="form-control input-border-bottom" name="downpayment" value="{{ $spk->downpayment }}" required>
                            <label for="downpayment" class="placeholder">Down Payment</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="discount" type="number" class="form-control input-border-bottom" name="discount" value="{{ $spk->discount }}">
                            <label for="discount" class="placeholder">Discount</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="payment" type="number" class="form-control input-border-bottom" name="payment" value="{{ $spk->payment }}" required>
                            <label for="payment" class="placeholder">Payment</label>
                        </div>
                    </div>

                    <div class="col-md-3" id="col-leasing">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="leasing_id" name="leasing_id" value="{{ $spk->leasing_id }}" required>
                            <input id="leasing_code" type="text" class="form-control input-border-bottom"
                                name="leasing_code" value="{{ $spk->leasing->leasing_code }}" data-toggle="modal"
                                data-target=".modalLeasing" required>
                            <label for="leasing_code" class="placeholder">Select Finance *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="manpower_id" name="manpower_id" value="{{ $spk->manpower_id }}" required>
                            <input id="manpower" type="text" class="form-control input-border-bottom"
                                name="manpower" value="{{ $spk->manpower->name }}" data-toggle="modal"
                                data-target=".modalManpower" required>
                            <label for="manpower" class="placeholder">Select Manpower *</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: -80px;">
                    <div class="col-md-3">
                        <div class="card" style="margin-top: 10px;">
                            <img src="{{ $spk->ktp == '' ? asset('img/noimage.jpg') : asset('img/ktp/'.$spk->ktp.'') }}" alt="{{ $spk->ktp }}" style="width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <br>
                        <button id="formImage" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#uploadKtp" aria-expanded="false" aria-controls="uploadKtp" style="font-weight: bold; width: 100%;">
                            Change ID-KTP photo
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
                        <br><br>
                    </div>
                </div>

                <input type="hidden" value="{{ $spk->ktp }}" name="ktp_file_prev">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control input-border-bottom" placeholder="Description" style="border: 1px dashed #e6e6e6; padding: 10px;">{{ $spk->description }}</textarea>
                            <label for="description" class="placeholder"></label>
                        </div>
                    </div>

                    
                </div>
                @if(Auth::user()->dealer_code == 'group')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $spk->stock->dealer->dealer_code }}" required>
                            <input id="dealer" type="text" class="form-control input-border-bottom"
                                name="dealer" value="{{ $spk->stock->dealer->dealer_name }}" required>
                            <label for="dealer" class="placeholder">Dealer *</label>
                        </div>
                    </div>
                </div>
                @else
                <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $spk->stock->dealer->dealer_code }}" required>
                @endif

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Stock')
@include('component.modal-data')
@include('component.modal-leasing')
@include('component.modal-manpower')
@include('component.modal-payment-method')
@include('component.modal-credit-status')
@include('component.modal-order-status')

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

    $('#on_hand').keypress(function(e){
        e.preventDefault();
    });

    $('#on_hand').keydown(function(e){
        e.preventDefault();
    });

    // document.addEventListener('contextmenu', function(e){
    //     e.preventDefault();
    // });

    function disable(){
        let creditStatus = document.getElementById("credit_status");
        creditStatus.value = 'Cash';
        creditStatus.setAttribute("disabled",true);
        document.getElementById("place").innerHTML = "Cash";
        document.getElementById("col-credit-status").setAttribute("hidden",true);

        document.getElementById("leasing_id").value = '1';
        document.getElementById("leasing_code").value = 'Cash';
        document.getElementById("col-leasing").setAttribute("hidden",true);
    }

    function enable(){
        let creditStatus = document.getElementById("credit_status");
        creditStatus.value = '';
        creditStatus.removeAttribute("disabled");
        document.getElementById("place").innerHTML = "Choose Credit Status *";
        document.getElementById("col-credit-status").removeAttribute("hidden");

        document.getElementById("leasing_id").value = '';
        document.getElementById("leasing_code").value = '';
        document.getElementById("col-leasing").removeAttribute("hidden");
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
