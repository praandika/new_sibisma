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

@section('title','Create SPK')
@section('page-title','SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">Data SPK</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Create</a>
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
                <h4 class="card-title">Create SPK</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('spk.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="spk_date" type="date" class="form-control input-border-bottom"
                                name="spk_date" value="{{ $today }}" required readonly>
                            <!-- <label for="spk_date" class="placeholder">Date *</label> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="customer_name" type="text" class="form-control input-border-bottom" name="customer_name" value="{{ old('customer_name') }}" style="text-transform: uppercase;"
                                data-toggle="modal"
                                data-target=".modalProspect" required>
                            <label for="customer_name" class="placeholder">Customer Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom" name="model_name" value="{{ old('model_name') }}" style="text-transform: uppercase;" required maxlength="100">
                            <label for="model_name" class="placeholder">Motor</label>
                            <span id="stockStatus"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no" value="{{ old('frame_no') }}" style="text-transform: uppercase;" required maxlength="100">
                            <label for="frame_no" class="placeholder">Frame No</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="engine_no" type="text" class="form-control input-border-bottom" name="engine_no" value="{{ old('engine_no') }}" style="text-transform: uppercase;" required maxlength="100">
                            <label for="engine_no" class="placeholder">Engine No</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color" value="{{ old('color') }}" style="text-transform: uppercase;" required maxlength="100">
                            <label for="color" class="placeholder">Faktur Color</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year" type="text" class="form-control input-border-bottom" name="year" value="{{ old('year') }}" style="text-transform: uppercase;" required maxlength="100">
                            <label for="year" class="placeholder">Year MC</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address_shipment" type="text" class="form-control input-border-bottom" name="address_shipment" value="{{ old('address_shipment') }}" style="text-transform: uppercase;" required maxlength="100">
                            <label for="address_shipment" class="placeholder">Pengiriman Address</label>
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

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@include('component.modal-prospect')
@include('component.modal-frame')

@push('after-script')
<script>

    $('#on_hand').keypress(function(e){
        e.preventDefault();
    });

    $('#on_hand').keydown(function(e){
        e.preventDefault();
    });

    function showReason() {

        let status = $('#credit_status').val().toLowerCase();

        if (status === 'reject' || status === 'cancel') {
            $('#col-leasing-reason').removeAttr('hidden');
            $('#col-leasing-reason').attr('required', true);
        } else {
            $('#col-leasing-reason').attr('hidden', true);
            $('#col-leasing-reason').removeAttr('required');
        }

    }

    function showLeasingGroup() {

        let payment_method = $('#payment_method').val().toLowerCase();

        if (payment_method === 'credit') {
            $('#col-leasing-bunga').removeAttr('hidden');
            $('#col-leasing-tenor').removeAttr('hidden');
            $('#col-leasing-namapemohon').removeAttr('hidden');
            $('#col-credit-status').removeAttr('hidden');
            $('#leasing-label').text('Select Finance *');
            $('#credit_status').attr('required', true);
            $('#leasing_code').attr('required', true);
            $('#leasing_code_cash').removeAttr('required');
            $('#bunga').attr('required', true);
            $('#tenor').attr('required', true);
            $('#nama_pemohon').attr('required', true);
            $('#leasing_id').attr('required', true);
            $('#leasing_id_cash').removeAttr('required');
            $('#leasing_code').attr('data-target', '.modalLeasing');
            $('#leasing_code').val('');
        } else {
            $('#col-leasing-bunga').attr('hidden', true);
            $('#col-leasing-tenor').attr('hidden', true);
            $('#col-leasing-namapemohon').attr('hidden', true);
            $('#col-credit-status').attr('hidden', true);
            $('#credit_status').removeAttr('required');
            $('#leasing_code').removeAttr('required');
            $('#leasing_code_cash').attr('required', true);
            $('#bunga').removeAttr('required');
            $('#tenor').removeAttr('required');
            $('#nama_pemohon').removeAttr('required');
            $('#leasing_id').removeAttr('required');
            $('#leasing_id_cash').attr('required', true);
            $('#leasing-label').text('Select Micro/Instansi *');
            $('#leasing_code').attr('data-target', '.modalLeasingCash');
            $('#leasing_code').val('');
            $('#bunga').val('');
            $('#tenor').val('');
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

<script>
    // Check Stock
    function checkStock(model, color)
    {
        console.log("Model dikirim:", model)
        console.log("Warna dikirim:", color)

        $.get('/spk-checkstock',{
            model:model,
            color:color
        },function(res){

            console.log(res);
            console.log("ready =", res.ready);

            if(res.ready){
                console.log("READY")

                loadFrameModal(res.data);

                $('.modalFrame').modal('show');

            }else{

                $('#frame_no').val('');
                $('#frame_no').prop('disabled',true);

                $('#year').val('');
                $('#year').prop('disabled',true);

                $('#engine_no').val('');
                $('#engine_no').prop('disabled',true);
                

                $('#stockStatus')
                    .html('<span class="badge badge-warning">INDENT</span>');
            }

        });
    }
</script>
@endpush
