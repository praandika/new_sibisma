@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    .print-pdf:focus {
        color: #ffffff;
    }

    .btn-goyang {
        animation: goyang 0.8s ease-in-out infinite;
    }

    @keyframes goyang {
        0% {
            transform: rotate(0deg);
        }

        20% {
            transform: rotate(-2deg);
        }

        40% {
            transform: rotate(2deg);
        }

        60% {
            transform: rotate(-1.5deg);
        }

        80% {
            transform: rotate(1.5deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }

</style>
@endpush

@section('title','Show Sales')
@section('page-title','Show Sales')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale.index') }}">Data Sales</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Show</a>
</li>
@endpush
<!-- Status -->
<div class="col-md-4">
    <div class="card card-dark bg-dark-gradient curves-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right"><img src="{{ asset('img/payment_method1.png') }}" alt="payment method">
            </div>
            <h2 class="mb-2">{{ ucwords($data->payment_method) }}</h2>
            <p>Payment Method</p>
        </div>
    </div>
</div>

<div class="col-md-4">
    @if($data->payment_method == 'CASH' || $data->payment_method == 'cash')
    <div class="card card-dark bg-dark-gradient skew-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right">
                <img src="{{ asset('img/cash1.png') }}" alt="Cash">
            </div>
            <h2 class="mb-2">{{ ucwords($data->microfinance) }}</h2>
            <p>Microfinance</p>
        </div>
    </div>
    @else
    <div class="card card-dark bg-dark-gradient skew-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right">
                <img src="{{ asset('img/leasing1.png') }}" alt="Cash">
            </div>
            <h2 class="mb-2">{{ ucwords($data->leasing_name) }}</h2>
            <p>Microfinance</p>
        </div>
    </div>
    @endif
</div>

<div class="col-md-4">
    <div class="card card-dark bg-{{ 
        $data->spk->order_status == 'delivery' || $data->spk->order_status == 'DELIVERY'
        ? 'success' 
        : 'secondary'
        }}-gradient bubble-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right">
                @if($data->spk->order_status == 'delivery' || $data->spk->order_status == 'DELIVERY')
                <img src="{{ asset('img/delivery1.png') }}" alt="Delivery">
                @else
                <img src="{{ asset('img/pending-do1.png') }}" alt="Sold">
                @endif
            </div>
            <h2 class="mb-2">{{ ucwords($data->spk->order_status) }}</h2>
            <p>Order Status</p>
        </div>
    </div>
</div>
<!-- END Status -->

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">{{ $spk_no }}</h4>
                    <p class="text-muted" style="font-size: 12px;">Salesman: {{ $data->manpower }}</p>
                </div>
                <!-- CONTROL BUTTON -->
                <div class="col-md-6" style="text-align: right;">
                    @if($data->spk->order_status == 'sold' || $data->spk->order_status == 'SOLD')
                    <button type="button" class="btn btn-success btn-round print-pdf" style="margin-bottom: 20px;"
                        data-toggle="modal" data-target="#modalCreateDo">
                        <i class="fas fa-plus"></i>
                        &nbsp;&nbsp; <strong>Create DO</strong>
                    </button>
                    @endif

                    @if($data->spk->order_status == 'delivery' || $data->spk->order_status == 'DELIVERY')
                    <a href="{{ url('do-print',$spk_no) }}" class="btn btn-dark btn-round print-pdf"
                        style="margin-bottom: 20px;" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;
                        <strong>Print DO</strong>
                    </a>
                    &nbsp;
                    <a href="{{ url('do-download',$spk_no) }}" class="btn btn-success btn-round print-pdf"
                        style="margin-bottom: 20px;" target="_blank"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp; <strong>Download
                            PDF</strong>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <center>
                        <span class="badge badge-primary" style="font-size: 18px;">Customer Detail</span>
                    </center>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <th width="200">Tanggal</th>
                            <td>: {{ $data->sale_date }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama Pemesan</th>
                            <td>: {{ $data->customer_name }}</td>
                        </tr>

                        <!-- WA LINK -->
                        @php
                        $phone = preg_replace('/\D/', '', $data->phone);

                        if (substr($phone, 0, 2) === '62') {
                        $waPhone = $phone;
                        } elseif (substr($phone, 0, 1) === '0') {
                        $waPhone = '62' . substr($phone, 1);
                        } else {
                        $waPhone = '62' . $phone;
                        }

                        $text = 'Halo '.$data->customer_name.', terima kasih telah melakukan pembelian sepeda motor
                        '.$data->model_name.' di '.$data->dealer->dealer_name;
                        @endphp
                        <tr>
                            <th width="200">No. Telp</th>
                            <td>:
                                <a href="https://wa.me/{{ $waPhone }}?text={{ urlencode($text) }}" target="_blank"
                                    class="btn btn-goyang" style="
                                        color: white;
                                        background: green;
                                        padding: 5px 10px;
                                        border-radius: 50px;
                                        text-decoration: none;
                                    ">
                                    <i class="fab fa-whatsapp"></i>
                                    {{ $data->phone }}
                                </a>
                            </td>
                        </tr>
                        <!-- END WA LINK -->

                        <tr>
                            <th width="200">Nama STNK</th>
                            <td>: {{ $data->stnk_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">KTP</th>
                            <td>: {{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat KTP</th>
                            <td>: {{ $data->address }}</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat Kirim</th>
                            <td>: {{ $data->address_shipment }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <center>
                        <span class="badge badge-dark" style="font-size: 18px;">Unit Detail</span>
                    </center>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <th width="200">Type Motor</th>
                            <td>: {{ $data->model_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Frame No</th>
                            <td>: {{ $data->frame_no }}</td>
                        </tr>
                        <tr>
                            <th width="200">Engine No</th>
                            <td>: {{ $data->engine_no }}</td>
                        </tr>
                        <tr>
                            <th width="200">Warna Motor</th>
                            <td>: {{ $data->faktur_color }}</td>
                        </tr>
                        <tr>
                            <th width="200">Tahun Kendaraan</th>
                            <td>: {{ $data->year_mc }}</td>
                        </tr>
                        <tr>
                            <th width="200">Harga OTR</th>
                            <td>: Rp {{ number_format($data->price, 0, ',','.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <center>
                        <span class="badge badge-danger" style="font-size: 18px;">Payment Detail</span>
                    </center>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <th width="200">Payment Method</th>
                            <td>: {{ $data->payment_method }}</td>
                        </tr>
                        <tr>
                            @if($data->payment_method == 'CASH' || $data->payment_method == 'cash')
                            <th width="200">Microfinance</th>
                            <td>: {{ $data->microfinance }}</td>
                            @else
                            <th width="200">Finance</th>
                            <td>: {{ $data->leasing_name }}</td>
                            @endif
                        </tr>
                        @if($data->payment_method == 'CREDITCARD' || $data->payment_method == 'creditcard')
                        <tr>
                            <th width="200">Bunga</th>
                            <td>: {{ $data->spk->bunga }}</td>
                        </tr>
                        <tr>
                            <th width="200">Tenor</th>
                            <td>: {{ $data->spk->tenor }} Bulan</td>
                        </tr>
                        <tr>
                            <th width="200">Downpayment</th>
                            <td>: Rp {{ number_format($data->spk->downpayment, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama Pemohon</th>
                            <td>: {{ $data->spk->pemohon_name }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREATE DO -->
<div class="modal fade" id="modalCreateDo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-truck text-success mr-1"></i>
                    Proses Delivery Order
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>


            {{-- FORM --}}
            <form action="{{ route('do.process-do', $data->spk_no) }}" method="POST" id="formProcessDo">

                @csrf

                <div class="modal-body">

                    <p class="mb-3">
                        Silakan lengkapi informasi pengiriman
                        untuk membuat Delivery Order.
                    </p>


                    {{-- ========================= --}}
                    {{-- DATA SPK / SALES --}}
                    {{-- ========================= --}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-4 text-muted">
                                    SPK
                                </div>

                                <div class="col-8 font-weight-bold">
                                    {{ $data->spk_no }}
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-4 text-muted">
                                    Customer
                                </div>

                                <div class="col-8 font-weight-bold">
                                    {{ $data->customer_name ?: '-' }}
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-4 text-muted">
                                    Model
                                </div>

                                <div class="col-8">
                                    {{ $data->model_name ?: '-' }}
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-4 text-muted">
                                    Color
                                </div>

                                <div class="col-8">
                                    {{ $data->faktur_color ?: '-' }}
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-4 text-muted">
                                    Tahun
                                </div>

                                <div class="col-8">
                                    {{ $data->year_mc ?: '-' }}
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-4 text-muted">
                                    Frame
                                </div>

                                <div class="col-8 font-weight-bold">
                                    {{ $data->frame_no ?: '-' }}
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-4 text-muted">
                                    Engine
                                </div>

                                <div class="col-8">
                                    {{ $data->engine_no ?: '-' }}
                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- SELF PICKUP --}}
                    {{-- ========================= --}}

                    <div class="form-group">

                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input" id="selfPickup" name="self_pickup"
                                value="1">

                            <label class="custom-control-label" for="selfPickup" style="cursor: pointer;">

                                <strong>Ambil Sendiri</strong>

                                <small class="text-muted d-block">
                                    Customer mengambil unit langsung
                                    ke dealer.
                                </small>

                            </label>

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- DRIVER SECTION --}}
                    {{-- ========================= --}}

                    <div id="driverSection">

                        <div class="row">

                            {{-- DRIVER --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="driverName">
                                        Nama Sopir
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" id="driverName" name="driver_name"
                                        placeholder="Masukkan nama sopir">

                                </div>
                            </div>


                            {{-- BACKUP DRIVER --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="backupDriver">
                                        Backup Sopir
                                    </label>

                                    <input type="text" class="form-control" id="backupDriver" name="backup_driver"
                                        placeholder="Masukkan backup sopir">

                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- NOTES --}}
                    {{-- ========================= --}}

                    <div class="form-group">

                        <label for="doNotes">
                            Catatan
                        </label>

                        <textarea class="form-control" id="doNotes" name="notes" rows="2"
                            placeholder="Tambahkan catatan jika diperlukan"></textarea>

                    </div>


                    {{-- ========================= --}}
                    {{-- INFO --}}
                    {{-- ========================= --}}

                    <div class="alert alert-info mb-0">

                        <i class="fas fa-info-circle mr-1"></i>

                        SPK ini sudah berstatus
                        <strong>SOLD</strong>.

                        <br>

                        Proses ini akan membuat
                        <strong>Delivery Order</strong>
                        dan mengubah status pengiriman menjadi
                        <strong>PROCESS</strong>.

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">

                        <i class="fas fa-times mr-1"></i>
                        Batal

                    </button>


                    <button type="submit" class="btn btn-success" id="btnConfirmDo">

                        <i class="fas fa-truck mr-1"></i>
                        Cetak DO

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#modalCreateDo').on('shown.bs.modal', function () {

        if (!$('#selfPickup').is(':checked')) {
            $('#driverName').focus();
        }

    });
</script>

<script>
    $(document).on('change', '#selfPickup', function () {

        if ($(this).is(':checked')) {

            // Ambil sendiri
            $('#driverSection').slideUp(200);

            // Kosongkan input driver
            $('#driverName')
                .val('')
                .prop('required', false);

            $('#backupDriver')
                .val('')
                .prop('required', false);

        } else {

            // Dikirim
            $('#driverSection').slideDown(200);

            // Driver wajib diisi
            $('#driverName')
                .prop('required', true);

            $('#backupDriver')
                .prop('required', false);
        }

    });

</script>

<script>
    $('#formProcessDo').on('submit', function(e) {

        const selfPickup = $('#selfPickup').is(':checked');
        const driverName = $('#driverName').val().trim();

        // Jika bukan ambil sendiri, driver wajib
        if (!selfPickup && driverName === '') {

            e.preventDefault();

            $('#driverName').addClass('is-invalid');

            if (!$('#driverNameError').length) {
                $('#driverName').after(`
                    <div id="driverNameError" class="invalid-feedback">
                        Nama sopir wajib diisi jika unit dikirim.
                    </div>
                `);
            }

            $('#driverName').focus();

            return false;
        }

        $('#driverName').removeClass('is-invalid');
        $('#driverNameError').remove();

        $('#btnConfirmDo')
            .prop('disabled', true)
            .html(`
                <i class="fas fa-spinner fa-spin mr-1"></i>
                Memproses...
            `);
    });
</script>

@if(session('open_print'))
<script>
    $(document).ready(function () {

        const printUrl = @json(session('print_url'));

        if (printUrl) {
            window.open(printUrl, '_blank');
        }

    });
</script>
@endif
@endpush
