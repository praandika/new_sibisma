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

@section('title','Edit SPK')
@section('page-title','SPK')

@if(Auth::user()->access == 'salesman')
    @push('button')
    @section('button-title','Create SPK')
    @include('component.button-create-spk')
    @endpush
@endif

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
            <div class="row" style="padding-left: 20px;">
                <h4 class="card-title">Edit SPK</h4>
            </div>
            <div class="row" style="padding-left: 20px;">
                <div style="font-size: 12px; font-weight: bold;">{{ $spk->spk_no }}</div>
            </div>
            <div class="row" style="padding-left: 20px;">
                <div style="font-size: 12px;">{{ ucwords(strtolower(Auth::user()->name)) }}</div>
            </div>
        </div>

        <!-- START FORM -->
        <div class="card-body">
            <form action="{{ route('spk.update', $spk->id) }}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- MANDATORY INPUT -->
                <div class="card card-dark bg-dark-gradient curves-shadow">
                    <div class="row">
                        <!-- TANGGAL -->
                        <div class="col-md-3">
                            <div class=" form-group">
                                <label for="spk_date" style="color: #fff !important;">Date <span
                                        class="star">*</span></label>
                                <input id="spk_date" type="date" class="form-control form-control-sm" name="spk_date"
                                    value="{{ $spk->spk_date }}" required readonly>
                            </div>
                        </div>

                        <!-- NAMA KONSUMEN -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="customer_name" style="color: #fff !important;">Customer Name <span
                                        class="star">*</span></label>
                                <input id="customer_name" type="text" class="form-control form-control-sm"
                                    name="customer_name" value="{{ $spk->order_name }}"
                                    style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- TELP KONSUMEN -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone" style="color: #fff !important;">Phone <span
                                        class="star">*</span></label>
                                <input id="phone" type="text" class="form-control form-control-sm" name="phone"
                                    value="{{ $spk->spk_phone }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender" style="color: #fff !important;">Gender <span
                                        class="star">*</span></label>
                                <input id="gender_name" type="text" class="form-control form-control-sm" name="gender"
                                    data-toggle="modal" data-target=".modalGender" value="{{ $spk->gender }}"
                                    style="text-transform: uppercase; cursor: pointer;" required>
                            </div>
                        </div>

                        <!-- KTP -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ktp" style="color: #fff !important;">KTP No. <span
                                        class="star">*</span></label>
                                <input id="ktp" type="number" class="form-control form-control-sm" name="ktp"
                                    value="{{ $spk->ktp_number }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- KK -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kk" style="color: #fff !important;">KK No.</label>
                                <input id="kk" type="number" class="form-control form-control-sm" name="kk"
                                    value="{{ $spk->kk_number }}" style="text-transform: uppercase;">
                                <small id="kk" class="form-text">Disarankan mendapatkan nomor KK untuk
                                    keperluan analisa data (opsional)</small>
                            </div>
                        </div>

                        <!-- ALAMAT KTP -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address" style="color: #fff !important;">KTP Address <span
                                        class="star">*</span></label>
                                <input id="address" type="text" class="form-control form-control-sm" name="address"
                                    value="{{ $spk->address }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>

                        <!-- ALAMAT KIRIM -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address_shipment" style="color: #fff !important;">Pengiriman Address <span
                                        class="star">*</span></label>
                                <input id="address_shipment" type="text" class="form-control form-control-sm"
                                    name="address_shipment" value="{{ $spk->address_shipment }}"
                                    style="text-transform: uppercase;" required>

                                <!-- Checkbox -->
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="sameAddress" type="checkbox" value="">
                                        <span class="form-check-sign" style="color: orange !important;">Alamat sama
                                            dengan KTP</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HIDE CARD -->
                <div id="fieldForm">
                    <div class="row">
                        <!-- NAMA STNK -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stnk_name">STNK Name <span class="star">*</span></label>
                                <input id="stnk_name" type="text" class="form-control form-control-sm" name="stnk_name"
                                    value="{{ $spk->stnk_name }}" style="text-transform: uppercase;" required>

                                <!-- Checkbox -->
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="sameName" type="checkbox" value="">
                                        <span class="form-check-sign">Nama sama dengan KTP</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- MODEL MOTOR -->
                        <div class="col-md-3">
                            <div class="card card-dark bg-primary-gradient bubble-shadow">
                                <div class="form-group">
                                    <label for="model_name" style="color: white !important;">Motor <span
                                            class="star">*</span></label>
                                    <span id="stockStatus">
                                        @if($spk->order_status == 'INDENT')
                                        <span class="badge badge-danger">INDENT</span>
                                        @elseif($spk->order_status == 'READY')
                                        <span class="badge badge-success">READY</span>
                                        @elseif($spk->order_status == 'REQUEST STOCK')
                                        <span class="badge badge-warning">REQUEST STOCK</span>
                                        @elseif($spk->order_status == 'SOLD')
                                        <span class="badge badge-secondary">SOLD</span>
                                        @else
                                        <span class="badge badge-dark">EMPTY</span>
                                        @endif
                                    </span>
                                    <input id="model_name" type="text" class="form-control form-control-sm"
                                        name="model_name" value="{{ $spk->model_name }}"
                                        style="text-transform: uppercase; cursor: pointer;" data-toggle="modal"
                                        data-target=".modalStock" required readonly>

                                    <span id="frameStatus" style="color: white; font-size: 12px; font-weight: bold;">
                                        {{ $spk->frame_no }}
                                    </span>
                                    <div>
                                        <span id="engineStatus" style="color: white; font-size: 12px;">
                                            {{ $spk->engine_no }}
                                        </span>
                                        <span id="colorStatus"
                                            style="color: white; font-size: 12px; font-weight: bold;">
                                            {{ $spk->faktur_color }}
                                        </span>
                                        <span id="yearStatus" style="color: white; font-size: 12px;">
                                            {{ $spk->year_mc }}
                                        </span>
                                    </div>

                                    <!-- POINT CODE STOCK -->
                                    <input id="point_code" type="hidden" class="form-control form-control-sm"
                                        name="point_code" value="{{ $spk->point_code }}"
                                        style="text-transform: uppercase;" required readonly>
                                    
                                    <!-- DEALER NAME STOCK -->
                                    <input id="dealer_name" type="hidden" class="form-control form-control-sm"
                                        name="dealer_name" value=""
                                        style="text-transform: uppercase;" required readonly>
                                </div>
                                <!-- BUTTON -->
                                <div class="col-md-12 mb-2" id="btnRequest" hidden>
                                    <button style="all: unset; background: orange; color: black; padding: 5px 8px; border: none; border-radius: 20px; cursor: pointer;" type="button"
                                    data-toggle="modal"
                                        data-target=".modalRequestStock"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Kirim</button>
                                </div>
                                <!-- BUTTON REQUEST -->
                                <input
                                    type="hidden"
                                    name="request_type"
                                    id="request_type"
                                    value="">
                            </div>
                        </div>

                        <!-- HARGA MOTOR -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Price OTR <span class="star">*</span></label>
                                <input id="price" type="text" class="form-control form-control-sm rupiah" name="price"
                                    value="{{ $spk->price }}" style="text-transform: uppercase;" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- PAYMENT TYPE -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment">Payment Type <span class="star">*</span></label>
                                <input id="payment" type="text" class="form-control form-control-sm" name="payment"
                                    value="{{ $spk->payment_method }}" style="text-transform: uppercase;" required
                                    readonly>
                            </div>
                        </div>

                        @if($spk->payment_method == 'CASH')
                        <!-- MICROFINANCE -->
                        <div class="col-md-3" id="microfinanceInstansi">
                            <div class="form-group">
                                <label for="microfinance">Microfinance / Instansi <span class="star">*</span></label>
                                <input id="microfinance" type="text" class="form-control form-control-sm"
                                    name="microfinance" value="{{ $spk->microfinance }}"
                                    style="text-transform: uppercase; cursor:pointer;" data-toggle="modal"
                                    data-target=".modalMicrofinance" required>
                            </div>
                        </div>
                        @endif

                        <!-- Discount -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount">Discount <span class="star">*</span></label>
                                <input id="discount" type="text" class="form-control form-control-sm rupiah"
                                    name="discount" value="{{ $spk->discount }}" style="text-transform: uppercase;"
                                    required>
                            </div>
                        </div>

                        <!-- Deposit -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="deposit">Deposit <span class="star">*</span></label>
                                <input id="deposit" type="text" class="form-control form-control-sm rupiah"
                                    name="deposit" value="{{ $spk->deposit }}" style="text-transform: uppercase;"
                                    required>
                            </div>
                        </div>
                    </div>

                    @if($spk->payment_method != 'CASH')
                    <div id="leasingName" class="mt-2" {{ $spk->payment_method == 'CASH' ? 'hidden' : '' }}
                        style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <h3 style="font-size: 14px; font-weight: bold; margin-left: 10px;" class="form-label mt-2">
                            CREDIT INFO
                        </h3>

                        <div class="row">

                            <!-- LEASING NAME -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="leasing">Leasing Name <span class="star">*</span></label>
                                    <input id="leasing" type="text" class="form-control form-control-sm" name="leasing"
                                        value="{{ $spk->leasing }}" style="text-transform: uppercase;" required
                                        readonly>
                                </div>
                            </div>

                            <!-- NAMA PEMOHON -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pemohon_name">Nama Pemohon <span class="star">*</span></label>
                                    <input id="pemohon_name" type="text" class="form-control form-control-sm"
                                        name="pemohon_name" value="{{ $spk->pemohon_name }}"
                                        style="text-transform: uppercase;" required>
                                </div>
                            </div>

                            <!-- STATUS KREDIT -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="credit_status">Kredit Status <span class="star">*</span></label>
                                    <input id="credit_status" type="text" class="form-control form-control-sm"
                                        name="credit_status" value="{{ $spk->credit_status }}"
                                        style="text-transform: uppercase; cursor:pointer;" data-toggle="modal"
                                        data-target=".modalCreditStatus" required>
                                </div>
                            </div>

                            <!-- Downpayment -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="downpayment">Downpayment <span class="star">*</span></label>
                                    <input id="downpayment" type="text" class="form-control form-control-sm rupiah"
                                        name="downpayment" value="{{ $spk->downpayment }}"
                                        style="text-transform: uppercase;" required>
                                </div>
                            </div>

                            <!-- Tenor Pilih di Pop Up Modal -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tenor">Tenor <span class="star">*</span></label>
                                    <input id="tenor" type="text" class="form-control form-control-sm" name="tenor"
                                        value="{{ $spk->tenor }}" style="text-transform: uppercase; cursor:pointer;"
                                        data-toggle="modal" data-target=".modalTenor" required>
                                </div>
                            </div>

                            <!-- Bunga Pilih di Pop Up Modal -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bunga">Bunga <span class="star">*</span></label>
                                    <input id="bunga" type="text" class="form-control form-control-sm" name="bunga"
                                        value="{{ $spk->bunga }}" style="text-transform: uppercase; cursor:pointer;"
                                        data-toggle="modal" data-target=".modalBunga" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <!-- Frame No -->
                        <input id="frame_no" type="hidden" class="form-control form-control-sm" name="frame_no"
                            value="{{ $spk->frame_no }}" style="text-transform: uppercase;" required>

                        <!-- Engine No -->
                        <input id="engine_no" type="hidden" class="form-control form-control-sm" name="engine_no"
                            value="{{ $spk->engine_no }}" style="text-transform: uppercase;" required readonly>

                        <!-- Faktur Color -->
                        <input id="color" type="hidden" class="form-control form-control-sm" name="color"
                            value="{{ $spk->color }}" style="text-transform: uppercase;" required readonly>

                        <!-- Year MC -->
                        <input id="year" type="hidden" class="form-control form-control-sm" name="year"
                            value="{{ $spk->year }}" style="text-transform: uppercase;" required readonly>

                        <!-- Order Status -->
                        <input id="order_status" type="hidden" class="form-control form-control-sm" name="order_status"
                            value="{{ $spk->order_status }}" style="text-transform: uppercase;" required readonly>

                        <!-- Prospect Key -->
                        <input id="prospect_key" type="hidden" class="form-control form-control-sm" name="prospect_key"
                            value="{{ $spk->prospect_key }}" style="text-transform: uppercase;" required readonly>

                        <!-- SPK No -->
                        <input id="spk_no" type="hidden" class="form-control form-control-sm" name="spk_no"
                            value="{{ $spk->spk_no }}" style="text-transform: uppercase;" required readonly>

                        <!-- Salesman -->
                        <input id="manpower" type="hidden" class="form-control form-control-sm" name="manpower"
                            value="{{ Auth::user()->name }}" style="text-transform: uppercase;" required readonly>

                        <div class="col-md-3">
                            <div class="col-md-12" style="margin-top: 12px;">
                                <button class="btn btn-primary" type="button" data-toggle="collapse"
                                    data-target="#uploadKtp" aria-expanded="false" aria-controls="uploadKtp"
                                    style="font-weight: bold; width: 100%;"><i class="fa fa-upload"></i>&nbsp;&nbsp;
                                    Upload / Take an ID-KTP photo
                                </button>
                                <div class="collapse" id="uploadKtp">
                                    <div class="card card-body">
                                        <div class="form-group form-floating-label">
                                            <input id="picture" type="file" class="form-control input-border-bottom"
                                                name="picture" value="{{ old('picture') }}">
                                            <label for="picture" class="placeholder" style="
                                                background-color: forestgreen; 
                                                color: #ffffff !important; 
                                                font-weight: bold;
                                                width: 92%; 
                                                padding-left: 20px; 
                                                padding-right: 20px;
                                                padding-top: 10px; 
                                                border-radius: 5px;
                                                position: absolute;
                                                top: 20px;
                                                cursor: pointer;"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload File
                                            </label>
                                        </div>

                                        <div class="form-group form-floating-label" style="position: relative;">
                                            <input id="photo" type="file" accept="image/*" capture="user"
                                                class="form-control input-border-bottom" name="photo"
                                                value="{{ old('photo') }}">
                                            <label for="photo" class="placeholder" style="
                                                background-color: teal; 
                                                color: #ffffff !important; 
                                                font-weight: bold;
                                                width: 92%; 
                                                padding-left: 20px; 
                                                padding-right: 20px;
                                                padding-top: 10px; 
                                                border-radius: 5px;
                                                position: absolute;
                                                top: 20px;
                                                cursor: pointer;"><i class="fa fa-camera"></i>&nbsp;&nbsp;Take a Photo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Foto -->
                        <div class="preview" style="padding: 20px;">
                            <img id="previewImage" src="{{ asset('img/ktp/' . $spk->ktp) }}" class="img-thumbnail"
                                style="width:200px;height:150px;object-fit:contain;">
                        </div>

                        <!-- NOTE -->
                        <div class="col-md-12">
                            <div class="form-group form-floating-label">
                                <textarea name="description" id="description" cols="30" rows="10"
                                    class="form-control input-border-bottom" placeholder="NOTE:"
                                    style="border: 1px dashed #e6e6e6; padding: 10px; text-transform: uppercase;">
                                    {{ $spk->description }}
                                </textarea>
                                <label for="description" class="placeholder"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="col-md-12">
                    <div id="fieldBtn">
                        <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                    </div>
                </div>

            </form>
            <!-- END FORM -->
        </div>
    </div>

    @include('component.modal-tenor')
    @include('component.modal-bunga')
    @include('component.modal-credit-status')
    @include('component.modal-microfinance')
    @include('component.modal-stock')
    @include('component.modal-gender')
    @include('component.modal-request-stock')

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

    <script>
        $('#btnRequest').click(function(){

            $('#reqDealer').text($('#point_code').val());

            $('#reqModel').text($('#model_name').val());

            $('#reqColor').text($('#color').val());

            $('#reqYear').text($('#year').val());

            $('#reqPrice').text(formatRupiah($('#price').val()));

            $('#reqDealerName').text($('#dealer_name').val().toUpperCase());

            $('#modalRequestStock').modal('show');

        });
</script>
    @endpush
