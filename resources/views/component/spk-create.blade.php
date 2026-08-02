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

    input {
        background-color: #fffbeb !important;
    }

    .star {
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
                <div class="card card-dark bg-dark-gradient curves-shadow">
                    <div class="row">
                        <!-- TANGGAL -->
                        <div class="col-md-3"">
                        <div class=" form-group">
                            <label for="spk_date" style="color: #fff !important;">Date <span
                                    class="star">*</span></label>
                            <input id="spk_date" type="date" class="form-control form-control-sm" name="spk_date"
                                value="{{ $today }}" required readonly>
                        </div>
                    </div>

                    <!-- NAMA KONSUMEN -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="customer_name" style="color: #fff !important;">Customer Name <span
                                    class="star">*</span></label>
                            <span id="genderText"></span>
                            <span id="phoneText" style="font-size: 12px; font-weight: bold;"></span>
                            <input id="customer_name" type="text" class="form-control form-control-sm"
                                name="customer_name" value="{{ old('customer_name') }}"
                                style="text-transform: uppercase; cursor:pointer;" data-toggle="modal"
                                data-target=".modalProspect" required>
                            <button id="btnSyncProspect" style="
                                    border: none;
                                    cursor: pointer;
                                    background-color: #fda552;
                                    border-radius: 0 0 10px 10px;
                                ">
                                <i class="fas fa-sync"></i> Update
                            </button>

                            <span id="syncInfo" class="ml-3 text-warning font-weight-bold"></span>
                        </div>
                    </div>
                </div>
        </div>

        <!-- HIDE CARD -->
        <div id="fieldForm" hidden>
            <div class="row">
                <!-- NAMA STNK -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stnk_name">STNK Name <span class="star">*</span></label>
                        <input id="stnk_name" type="text" class="form-control form-control-sm" name="stnk_name"
                            value="{{ old('stnk_name') }}" style="text-transform: uppercase;" required>

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
                        <input id="model_name" type="text" class="form-control form-control-sm" name="model_name"
                            value="{{ old('model_name') }}" style="text-transform: uppercase;" required readonly>

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
                        <input id="price" type="text" class="form-control form-control-sm rupiah" name="price"
                            value="{{ old('price') }}" style="text-transform: uppercase;" required>
                    </div>
                </div>

                <!-- KTP -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ktp">KTP No. <span class="star">*</span></label>
                        <input id="ktp" type="number" class="form-control form-control-sm" name="ktp"
                            value="{{ old('ktp') }}" style="text-transform: uppercase;" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- KK -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="kk">KK No.</label>
                        <input id="kk" type="number" class="form-control form-control-sm" name="kk"
                            value="{{ old('kk') }}" style="text-transform: uppercase;">
                        <small id="kk" class="form-text text-muted">Disarankan mendapatkan nomor KK untuk
                            keperluan analisa data (opsional)</small>
                    </div>
                </div>

                <!-- ALAMAT KTP -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="address">KTP Address <span class="star">*</span></label>
                        <input id="address" type="text" class="form-control form-control-sm" name="address"
                            value="{{ old('address') }}" style="text-transform: uppercase;" required>
                    </div>
                </div>

                <!-- ALAMAT KIRIM -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="address_shipment">Pengiriman Address <span class="star">*</span></label>
                        <input id="address_shipment" type="text" class="form-control form-control-sm"
                            name="address_shipment" value="{{ old('address_shipment') }}"
                            style="text-transform: uppercase;" required>

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
                        <input id="payment" type="text" class="form-control form-control-sm" name="payment"
                            value="{{ old('payment') }}" style="text-transform: uppercase;" required readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- MICROFINANCE -->
                <div class="col-md-3" id="microfinanceInstansi" hidden>
                    <div class="form-group">
                        <label for="microfinance">Microfinance / Instansi <span class="star">*</span></label>
                        <input id="microfinance" type="text" class="form-control form-control-sm" name="microfinance"
                            value="{{ old('microfinance') }}" style="text-transform: uppercase; cursor:pointer;"
                            data-toggle="modal" data-target=".modalMicrofinance" required>
                    </div>
                </div>

                <!-- Discount -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="discount">Discount <span class="star">*</span></label>
                        <input id="discount" type="text" class="form-control form-control-sm rupiah" name="discount"
                            value="{{ old('discount') }}" style="text-transform: uppercase;" required>
                    </div>
                </div>

                <!-- Deposit -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="deposit">Deposit <span class="star">*</span></label>
                        <input id="deposit" type="text" class="form-control form-control-sm rupiah" name="deposit"
                            value="{{ old('deposit') }}" style="text-transform: uppercase;" required>
                    </div>
                </div>
            </div>

            <div id="leasingName" hidden style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3 style="font-size: 14px; font-weight: bold; margin-left: 10px;" class="form-label mt-2">CREDIT INFO
                </h3>

                <div class="row">

                    <!-- LEASING NAME -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="leasing">Leasing Name <span class="star">*</span></label>
                            <input id="leasing" type="text" class="form-control form-control-sm" name="leasing"
                                value="{{ old('leasing') }}" style="text-transform: uppercase;" required readonly>
                        </div>
                    </div>

                    <!-- NAMA PEMOHON -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pemohon_name">Nama Pemohon <span class="star">*</span></label>
                            <input id="pemohon_name" type="text" class="form-control form-control-sm"
                                name="pemohon_name" value="{{ old('pemohon_name') }}" style="text-transform: uppercase;"
                                required>
                        </div>
                    </div>

                    <!-- STATUS KREDIT -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="credit_status">Kredit Status <span class="star">*</span></label>
                            <input id="credit_status" type="text" class="form-control form-control-sm"
                                name="credit_status" value="{{ old('credit_status') }}"
                                style="text-transform: uppercase; cursor:pointer;" data-toggle="modal"
                                data-target=".modalCreditStatus" required>
                        </div>
                    </div>

                    <!-- Downpayment -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="downpayment">Downpayment <span class="star">*</span></label>
                            <input id="downpayment" type="text" class="form-control form-control-sm rupiah"
                                name="downpayment" value="{{ old('downpayment') }}" style="text-transform: uppercase;"
                                required>
                        </div>
                    </div>

                    <!-- Tenor Pilih di Pop Up Modal -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tenor">Tenor <span class="star">*</span></label>
                            <input id="tenor" type="text" class="form-control form-control-sm" name="tenor"
                                value="{{ old('tenor') }}" style="text-transform: uppercase; cursor:pointer;"
                                data-toggle="modal" data-target=".modalTenor" required>
                        </div>
                    </div>

                    <!-- Bunga Pilih di Pop Up Modal -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bunga">Bunga <span class="star">*</span></label>
                            <input id="bunga" type="text" class="form-control form-control-sm" name="bunga"
                                value="{{ old('bunga') }}" style="text-transform: uppercase; cursor:pointer;"
                                data-toggle="modal" data-target=".modalBunga" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Frame No -->
                <input id="frame_no" type="hidden" class="form-control form-control-sm" name="frame_no"
                    value="{{ old('frame_no') }}" style="text-transform: uppercase;" required>

                <!-- Engine No -->
                <input id="engine_no" type="hidden" class="form-control form-control-sm" name="engine_no"
                    value="{{ old('engine_no') }}" style="text-transform: uppercase;" required readonly>

                <!-- Faktur Color -->
                <input id="color" type="hidden" class="form-control form-control-sm" name="color"
                    value="{{ old('color') }}" style="text-transform: uppercase;" required readonly>

                <!-- Year MC -->
                <input id="year" type="hidden" class="form-control form-control-sm" name="year"
                    value="{{ old('year') }}" style="text-transform: uppercase;" required readonly>

                <!-- Order Status -->
                <input id="order_status" type="hidden" class="form-control form-control-sm" name="order_status"
                    value="{{ old('order_status') }}" style="text-transform: uppercase;" required readonly>

                <!-- Phone -->
                <input id="phone" type="hidden" class="form-control form-control-sm" name="phone"
                    value="{{ old('phone') }}" style="text-transform: uppercase;" required readonly>

                <!-- SPK No -->
                <input id="spk_no" type="hidden" class="form-control form-control-sm" name="spk_no"
                    value="{{ $spk_no }}" style="text-transform: uppercase;" required readonly>

                <!-- Prospect Date -->
                <input id="prospect_date" type="hidden" class="form-control form-control-sm" name="prospect_date"
                    value="{{ old('prospect_date') }}" style="text-transform: uppercase;" required>

                <!-- Prospect Key -->
                <input id="prospect_key" type="hidden" class="form-control form-control-sm" name="prospect_key"
                    value="{{ old('prospect_key') }}" style="text-transform: uppercase;" required readonly>

                <!-- Gender -->
                <input id="gender" type="hidden" class="form-control form-control-sm" name="gender"
                    value="{{ old('gender') }}" style="text-transform: uppercase;" required>

                <!-- Salesman -->
                <input id="manpower" type="hidden" class="form-control form-control-sm" name="manpower"
                    value="{{ Auth::user()->name }}" style="text-transform: uppercase;" required readonly>

                <div class="col-md-3" style="margin-top: 12px;">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#uploadKtp"
                        aria-expanded="false" aria-controls="uploadKtp" style="font-weight: bold;">
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
                                    class="form-control input-border-bottom" name="photo" value="{{ old('photo') }}">
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

                <!-- Preview Foto -->
                <div class="preview" style="padding: 20px;">
                    <img id="previewImage" src="{{ asset('img/noimage.jpg') }}" class="img-thumbnail"
                        style="width:200px;height:150px;object-fit:contain;">
                </div>

                <!-- NOTE -->
                <div class="col-md-12">
                    <div class="form-group form-floating-label">
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="form-control input-border-bottom" placeholder="NOTE:"
                            value="{{ old('description') }}"
                            style="border: 1px dashed #e6e6e6; padding: 10px; text-transform: uppercase;"></textarea>
                        <label for="description" class="placeholder"></label>
                    </div>
                </div>
            </div>
        </div>


        <div id="fieldBtn" hidden>
            <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
        </div>
        </form>
    </div>
</div>
</div>

@include('component.modal-tenor')
@include('component.modal-bunga')
@include('component.modal-credit-status')
@include('component.modal-microfinance')
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

    function checkStock(model, color) {
        currentModel = model;
        currentColor = color;

        console.log("Model dikirim:", model)
        console.log("Warna dikirim:", color)

        $.get('/spk-checkstock', {
            model: model,
            color: color
        }, function (res) {

            console.log(res);
            console.log("ready =", res.ready);

            if (res.ready) {
                console.log("READY")

                loadFrameModal();

                $('.modalFrame').modal('show');
                $('#order_status').val('READY');

            } else {

                $('#frame_no').val('');
                $('#year').val('');
                $('#engine_no').val('');
                $('#color').val('');
                $('#order_status').val('INDENT');

                $('#stockStatus')
                    .html('<span class="badge badge-warning">INDENT</span>');
            }

        });
    }

</script>

<script>
    // Button Manual Sync Prospect
    $('#btnSyncProspect').click(function () {

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

            success: function (res) {

                $('#btnSyncProspect').prop('disabled', false);

                $('#syncInfo').html(
                    '<span class="badge badge-success">' +
                    res.new_data +
                    ' Prospect baru</span>'
                );

                loadProspect();

            },

            error: function (xhr) {
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
    $('#sameAddress').change(function () {
        if ($(this).is(':checked')) {
            $('#address_shipment').val($('#address').val());
        } else {
            $('#address_shipment').val('');
        }
    });

    // Checkbox data yang sama
    $('#sameName').change(function () {
        if ($(this).is(':checked')) {
            $('#stnk_name').val($('#customer_name').val());
        } else {
            $('#stnk_name').val('');
        }
    });

</script>

<script>
    // Format Rupiah
    function formatRupiah(angka) {
        angka = angka.toString().replace(/\D/g, '');

        if (angka == '') return '';

        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    // Hapus format saat mulai mengetik
    $(document).on('focus', '.rupiah', function () {

        let value = $(this).val()
            .replace('Rp', '')
            .replace(/\./g, '')
            .trim();

        $(this).val(value);

    });

    $(document).on('blur', '.rupiah', function () {

        $(this).val(
            formatRupiah($(this).val())
        );

    });

    // Check Price
    function getPrice(model) {
        $.get('/spk-checkprice', {
            model: model
        }, function (res) {

            $('#price').val(
                formatRupiah(res.price)
            );

        });
    }

</script>

<script>
    // Preview foto
    $('#photo').change(function () {

        let photos = this.photoss[0];

        if (photos) {

            let reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(photos);
        }
    });

    // Preview file
    $('#picture').change(function () {

        let file = this.files[0];

        if (file) {

            let reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(file);
        }
    });

</script>
@endpush
