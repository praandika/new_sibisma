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

    input{
        background-color: #fffbeb !important;
    }

    .star{
        color: red;
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
            <div class="row" style="padding-left: 20px;">
                <h4 class="card-title">Create SPK</h4>
            </div>
            <div class="row" style="padding-left: 20px;">
                <div style="font-size: 12px; font-weight: bold;">{{ $spk_no }}</div>
            </div>
            <div class="row" style="padding-left: 20px;">
                <div style="font-size: 12px;">{{ ucwords(strtolower(Auth::user()->name)) }}</div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('spk.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- TANGGAL -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="spk_date">Date <span class="star">*</span></label>
                            <input id="spk_date" type="date" class="form-control form-control-sm"
                                name="spk_date" value="{{ $today }}" required readonly>
                        </div>
                    </div>

                    <!-- NAMA KONSUMEN -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="customer_name">Customer Name <span class="star">*</span></label>
                            <input id="customer_name" type="text" class="form-control form-control-sm" name="customer_name" value="{{ old('customer_name') }}" style="text-transform: uppercase;"
                                data-toggle="modal"
                                data-target=".modalProspect" required>
                            <button id="btnSyncProspect"
                                style="
                                    border: none;
                                    cursor: pointer;
                                    background-color: #65eb89;
                                    border-radius: 0 0 10px 10px;
                                ">
                                <i class="fas fa-sync"></i> Update
                            </button>

                            <span id="syncInfo" class="ml-3 text-success font-weight-bold"></span>
                        </div>
                    </div>

                    <!-- HIDE CARD -->
                    <div id="fieldForm" hidden>
                        <!-- NAMA STNK -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stnk_name">STNK Name <span class="star">*</span></label>
                                <input id="stnk_name" type="text" class="form-control form-control-sm" name="stnk_name" value="{{ old('stnk_name') }}" style="text-transform: uppercase;" required>

                                <!-- Checkbox -->
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="sameName" type="checkbox" value="">
                                            <span class="form-check-sign">Nama sama dengan KTP</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="model_name">Motor <span class="star">*</span></label>
                                <span id="stockStatus"></span>
                                <input id="model_name" type="text" class="form-control form-control-sm" name="model_name" value="{{ old('model_name') }}" style="text-transform: uppercase;" required readonly>
                                
                                <span id="frameStatus" style="color: grey; font-size: 12px; font-weight: bold;"></span>
                                <div>
                                    <span id="engineStatus" style="color: grey; font-size: 12px;"></span>
                                    <span id="colorStatus" style="color: grey; font-size: 12px; font-weight: bold;"></span>
                                    <span id="yearStatus" style="color: grey; font-size: 12px;"></span>
                                </div>
                            </div>
                        </div>

                        <!-- HARGA MOTOR -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Price OTR <span class="star">*</span></label>
                                <input id="price" type="text" class="form-control form-control-sm" name="price" value="{{ old('price') }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- KTP -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ktp">KTP No. <span class="star">*</span></label>
                                <input id="ktp" type="text" class="form-control form-control-sm" name="ktp" value="{{ old('ktp') }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- KK -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kk">KK No.</label>
                                <input id="kk" type="text" class="form-control form-control-sm" name="kk" value="{{ old('kk') }}" style="text-transform: uppercase;">
                                <small id="kk" class="form-text text-muted">Disarankan mendapatkan nomor KK untuk keperluan analisa data (opsional)</small>
                            </div>
                        </div>

                        <!-- ALAMAT KTP -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address">KTP Address <span class="star">*</span></label>
                                <input id="address" type="text" class="form-control form-control-sm" name="address" value="{{ old('address') }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- ALAMAT KIRIM -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address_shipment">Pengiriman Address <span class="star">*</span></label>
                                <input id="address_shipment" type="text" class="form-control form-control-sm" name="address_shipment" value="{{ old('address_shipment') }}" style="text-transform: uppercase;" required>

                                <!-- Checkbox -->
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="sameAddress" type="checkbox" value="">
                                            <span class="form-check-sign">Alamat sama dengan KTP</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- PAYMENT TYPE -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment">Payment Type <span class="star">*</span></label>
                                <input id="payment" type="text" class="form-control form-control-sm" name="payment" value="{{ old('payment') }}" style="text-transform: uppercase;" required readonly>
                            </div>
                        </div>

                        <!-- LEASING NAME -->
                        <div class="col-md-3" id="leasingName" hidden>
                            <div class="form-group">
                                <label for="leasing">Leasing Name <span class="star">*</span></label>
                                <input id="leasing" type="text" class="form-control form-control-sm" name="leasing" value="{{ old('leasing') }}" style="text-transform: uppercase;" required readonly>
                            </div>
                        </div>

                        <!-- Frame No -->
                        <input id="frame_no" type="hidden" class="form-control form-control-sm" name="frame_no" value="{{ old('frame_no') }}" style="text-transform: uppercase;" required>

                        <!-- Engine No -->
                        <input id="engine_no" type="hidden" class="form-control form-control-sm" name="engine_no" value="{{ old('engine_no') }}" style="text-transform: uppercase;" required readonly>

                        <!-- Faktur Color -->
                        <input id="color" type="hidden" class="form-control form-control-sm" name="color" value="{{ old('color') }}" style="text-transform: uppercase;" required readonly>

                        <!-- Year MC -->
                        <input id="year" type="hidden" class="form-control form-control-sm" name="year" value="{{ old('year') }}" style="text-transform: uppercase;" required readonly>

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
                </div>

                <div id="fieldBtn" hidden>
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                    <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('component.modal-prospect')
@include('component.modal-frame')

@push('after-script')
<script>
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
    let currentModel = '';
    let currentColor = '';

    function checkStock(model, color)
    {
        currentModel = model;
        currentColor = color;

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

                loadFrameModal();

                $('.modalFrame').modal('show');

            }else{

                $('#frame_no').val('');
                $('#year').val('');
                $('#engine_no').val('');
                $('#color').val('');

                $('#stockStatus')
                    .html('<span class="badge badge-warning">INDENT</span>');
            }

        });
    }
</script>

<script>
    // Button Manual Sync Prospect
    $('#btnSyncProspect').click(function(){

        $('#btnSyncProspect').prop('disabled', true);

        $('#syncInfo').html(
            '<i class="fas fa-spinner fa-spin"></i> Synchronizing...'
        );

        $.ajax({

            url: "{{ route('dpack.manual-prospect') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}"
            },

            success: function(res){

                $('#btnSyncProspect').prop('disabled', false);

                $('#syncInfo').html(
                    '<span class="badge badge-success">' +
                    res.new_data +
                    ' Prospect baru</span>'
                );

                loadProspect();

            },

            error:function(xhr){
                console.log(xhr.status);
                console.log(xhr.responseText);

                $('#btnSyncProspect').prop('disabled', false);

                $('#syncInfo').html(
                    '<span class="badge badge-danger">Sync gagal</span>'
                );

            }

        });

    }); 
</script>

<script>
    // Checkbox data yang sama
    $('#sameAddress').change(function(){
        if($(this).is(':checked')){
            $('#address_shipment').val($('#address').val());
        }else{
            $('#address_shipment').val('');
        }
    });

    // Checkbox data yang sama
    $('#sameName').change(function(){
        if($(this).is(':checked')){
            $('#stnk_name').val($('#customer_name').val());
        }else{
            $('#stnk_name').val('');
        }
    });
</script>

<script>
    // Format Rupiah
    function formatRupiah(angka)
    {
        angka = angka.toString().replace(/\D/g,'');

        if(angka == '') return '';

        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    // Hapus format saat mulai mengetik
    $('#price').on('focus', function(){

        let value = $(this).val()
            .replace('Rp','')
            .replace(/\./g,'')
            .trim();

        $(this).val(value);

    });

    // Format kembali saat selesai mengetik
    $('#price').on('blur', function(){

        $(this).val(
            formatRupiah($(this).val())
        );

    });

    // Check Price
    function getPrice(model)
    {
        $.get('/spk-checkprice', {
            model: model
        }, function(res){

            $('#price').val(
                formatRupiah(res.price)
            );

        });
    }
</script>
@endpush
