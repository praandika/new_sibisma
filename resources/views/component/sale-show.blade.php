@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    .print-pdf:focus {
        color: #ffffff;
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
        $data->status == 'delivered' || $data->order_status == 'DELIVERED' |
        ? 'success' 
        : 'secondary
        }}-gradient bubble-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right">
                @if($data->status == 'delivered')
                <img src="{{ asset('img/delivery1.png') }}" alt="Delivered">
                @else
                <img src="{{ asset('img/pending-do1.png') }}" alt="Pending">
                @endif
            </div>
            <h2 class="mb-2">{{ ucwords($data->status) }}</h2>
            <p>Sales Status</p>
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
                </div>
                <!-- CONTROL BUTTON -->
                @if($data->status == 'pending')
                    <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-success btn-round print-pdf" style="margin-bottom: 20px;"
                        data-toggle="modal" data-target="#modalCreateDo">
                        <i class="fas fa-check"></i>
                        &nbsp;&nbsp; <strong>Create DO</strong>
                    </button>
                @endif

                @if($data->status == 'delivered')
                    <a href="{{ url('do-print',$spk_no) }}" class="btn btn-dark btn-round print-pdf"
                        style="margin-bottom: 20px;" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;
                        <strong>Print DO</strong>
                    </a>
                    &nbsp;
                    <a href="{{ url('do-download',$spk_no) }}" class="btn btn-success btn-round print-pdf"
                        style="margin-bottom: 20px;"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp; <strong>Download
                            PDF</strong>
                    </a>
                @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <h2>Unit and Customer Detail</h2>
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
                        <tr>
                            <th width="200">Nama STNK</th>
                            <td>: {{ $data->stnk_name }}</td>
                        <tr>
                            <th width="200">KTP</th>
                            <td>: {{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat KTP</th>
                            <td>: {{ $data->address }}</td>
                        </tr>
                        <tr>
                            <th width="200">No. Telp</th>
                            <td>: {{ $data->phone }}</td>
                        </tr>
                        <tr>
                            <th width="200">Type Motor</th>
                            <td>: {{ $data->model_name }}</td>
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
                        <tr>
                            @if($data->payment_method == 'CASH' || $data->payment_method == 'cash')
                            <th width="200">Microfinance</th>
                            <td>: {{ $data->microfinance }}</td>
                            @else
                            <th width="200">Finance</th>
                            <td>: {{ $data->leasing_name }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th width="200">Manpower</th>
                            <td>: {{ $data->manpower }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI JUAL -->
<div class="modal fade" id="modalCreateDo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle text-success mr-1"></i>
                    Konfirmasi Delivery Order
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <p>
                    Apakah Anda yakin ingin memproses DO ini?
                </p>

                <div class="card bg-light">
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-5">SPK</div>
                            <div class="col-7 font-weight-bold">
                                {{ $data->spk_no }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5">Customer</div>
                            <div class="col-7">
                                {{ $data->customer_name }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5">Model</div>
                            <div class="col-7">
                                {{ $data->model_name }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5">Color</div>
                            <div class="col-7">
                                {{ $data->faktur_color }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">Frame</div>
                            <div class="col-7">
                                {{ $data->frame_no ?: '-' }}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Setelah dikonfirmasi, Penjualan akan tercatat sebagai
                    <strong>DELIVERED</strong> dan masuk ke laporan penjualan.
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    Batal
                </button>

                <form action="{{ route('do.process-do', $data->spk_no) }}" method="POST" id="formProcessDo">

                    @csrf

                    <button type="submit" class="btn btn-success" id="btnConfirmDo">
                        <i class="fas fa-check mr-1"></i>
                        Ya, Proses DO
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>
