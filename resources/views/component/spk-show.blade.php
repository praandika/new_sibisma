@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    .print-pdf:focus{
        color: #ffffff;
    }
</style>
@endpush

@section('title','Show SPK')
@section('page-title','Show SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">Data SPK</a>
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
                <div class="h1 fw-bold float-right"><img src="{{ asset('img/payment_method1.png') }}" alt="payment method"></div>
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
        <div class="card card-dark bg-{{ $data->credit_status == 'survey' ? 'info' : ($data->credit_status == 'acc' ? 'success' : 'danger') }}-gradient skew-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right">
                    @if($data->credit_status == 'survey')
                    <img src="{{ asset('img/survey1.png') }}" alt="Survey">
                    @elseif($data->credit_status == 'acc')
                    <img src="{{ asset('img/acc1.png') }}" alt="Acc">
                    @elseif($data->credit_status == 'reject')
                    <img src="{{ asset('img/reject1.png') }}" alt="Reject">
                    @else
                    <img src="{{ asset('img/cash1.png') }}" alt="Cash">
                    @endif
                </div>
                <h2 class="mb-2">{{ ucwords($data->credit_status) }}</h2>
                <p>Credit Status</p>
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-{{ 
        $data->order_status == 'indent' || $data->order_status == 'INDENT' || $data->order_status == 'rejected' || $data->order_status == 'REJECTED' 
        ? 'danger' 
        : (
            $data->order_status == 'ready' || $data->order_status == 'READY'
                ? 'success' 
                : (
                    $data->order_status == 'sold' || $data->order_status == 'SOLD'
                        ? 'secondary'
                        : (
                            $data->order_status == 'delivered' || $data->order_status == 'DELIVERED'
                                ? 'success'
                                : 'warning'
                            )
                    )
            ) 
        }}-gradient bubble-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right">
                    @if($data->order_status == 'indent' || $data->order_status == 'rejected')
                    <img src="{{ asset('img/indent1.png') }}" alt="Indent">
                    @elseif($data->order_status == 'ready')
                    <img src="{{ asset('img/available1.png') }}" alt="Ready">
                    @else
                    <img src="{{ asset('img/indent1.png') }}" alt="Request Stock">
                    @endif
                </div>
                <h2 class="mb-2">{{ ucwords($data->order_status) }}</h2>
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
                </div>
                <!-- CONTROL BUTTON -->
                <div class="col-md-6" style="text-align: right;">
                    @if(Auth::user()->access != 'salesman')
                        @if(
                            filled($data->ktp_number) &&
                            filled($data->spk_phone) &&
                            filled($data->address_shipment) &&
                            filled($data->frame_no) &&
                            filled($data->faktur_color) &&
                            filled($data->ktp) &&
                            filled($data->stnk_name)
                        )
                            @if(
                                $data->order_status == 'sold' || 
                                $data->order_status == 'SOLD'
                            )
                                <button type="button" class="btn btn-secondary btn-round print-pdf"
                                style="margin-bottom: 20px;" disabled><i class="fa fa-check"></i>&nbsp;&nbsp;<strong>Terjual</strong>
                                </button>
                                &nbsp;
                            @else
                                <button type="button"
                                        class="btn btn-secondary btn-round print-pdf"
                                        style="margin-bottom: 20px;"
                                        data-toggle="modal"
                                        data-target="#modalConfirmSale">
                                    <i class="fas fa-check"></i>
                                    &nbsp;&nbsp; <strong>Proses Jual</strong>
                                </button>
                                &nbsp;
                            @endif
                        @else
                            <button type="button" class="btn btn-secondary btn-round print-pdf"
                            style="margin-bottom: 20px;" disabled><i class="fa fa-check"></i>&nbsp;&nbsp;<strong>Proses Jual</strong>
                            </button>
                            &nbsp;
                        @endif
                    @endif
                    
                    @if(
                        $data->order_status == 'ready' || 
                        $data->order_status == 'READY' ||
                        $data->order_status == 'sold' || 
                        $data->order_status == 'SOLD')
                        <a href="{{ url('spk-print',$spk_no) }}" class="btn btn-dark btn-round print-pdf"
                            style="margin-bottom: 20px;" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp; <strong>Print SPK</strong>
                        </a>
                        &nbsp;
                        <a href="{{ url('spk-download',$spk_no) }}" class="btn btn-success btn-round print-pdf"
                            style="margin-bottom: 20px;"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp; <strong>Download PDF</strong>
                        </a>
                        &nbsp;
                        <a href="{{ route('spk.ktp-print',$spk_no) }}" class="btn btn-danger btn-round print-pdf"
                            style="margin-bottom: 20px;" target="_blank"><i class="fa fa-id-card"></i>&nbsp;&nbsp; <strong>Print KTP</strong>
                        </a>
                        &nbsp;
                        <a href="{{ route('spk.edit',$id) }}" class="btn btn-primary btn-round print-pdf"
                            style="margin-bottom: 20px;" target="_blank"><i class="fa fa-edit"></i>&nbsp;&nbsp; <strong>Edit SPK</strong>
                        </a>
                    @else
                        <a href="{{ route('spk.edit',$id) }}" class="btn btn-primary btn-round print-pdf"><i
                        class="fa fa-edit"></i>&nbsp;&nbsp; <strong>Edit SPK</strong></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <center>
                        <h2>SURAT PESANAN KENDARAAN (SPK)</h2>
                    </center>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <th width="200">Tanggal</th>
                            <td>: {{ $data->spk_date }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama Pemesan</th>
                            <td>: {{ $data->order_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama STNK</th>
                            <td>: {{ $data->stnk_name }}</td>
                        <tr>
                            <th width="200">KTP</th>
                            <td>: {{ $data->ktp_number }}</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat KTP</th>
                            <td>: {{ $data->customer_address }}</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat Pengiriman</th>
                            <td>: {{ $data->address_shipment }}</td>
                        </tr>
                        <tr>
                            <th width="200">No. Telp</th>
                            <td>: {{ $data->spk_phone }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama STNK & BPKB</th>
                            <td>: {{ $data->stnk_name }}</td>
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
                            <th width="200">Harga OTR</th>
                            <td>: Rp {{ number_format($data->price, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Uang Muka</th>
                            <td>: Rp {{ number_format($data->downpayment, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Potongan</th>
                            <td>: Rp {{ number_format($data->discount, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            @if($data->payment_method == 'CASH' || $data->payment_method == 'cash')
                                <th width="200">Microfinance</th>
                                <td>: {{ $data->microfinance }}</td>
                            @else
                                <th width="200">Finance</th>
                                <td>: {{ $data->leasing }} {{ $data->bunga }} {{ $data->tenor == '' ? $data->tenor : $data->tenor.' Bulan' }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th width="200">Salesman</th>
                            <td>: {{ $data->salesman }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <center>
                        <h2>FORM SPK Processing</h2>
                    </center>
                    <br>
                    <div class="cekbox-container" style="padding-left: 30px;">
                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Konfirmasi
                                Pembelian</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Konfirmasi Pengiriman
                                | Tgl_____________</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">PDI</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Valid Data
                                (KTP,KK,Domisili)</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">DPACK</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Kepemilikan
                                Motor</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Faktur |
                                Tgl_____________</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                                for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Tagihan Leasing |
                                Tgl_____________</label>
                        </div>

                        <textarea name="description" id="description" cols="30" rows="10"
                            class="form-control input-border-bottom" readonly
                            style="border: 1px dashed grey; padding: 10px;">
                            {{ $data->tandajadi > 0 ? 'Tanda Jadi '.number_format($data->tandajadi, 0, ',','.') : '' }}{{ $data->description }}
                        </textarea>
                        
                            <div class="card" style="margin-top: 10px;">
                                <div class="card-body">
                                    <img src="{{ $data->ktp == '' ? asset('img/noimage.jpg') : asset('img/ktp/'.$data->ktp.'') }}" alt="{{ $data->ktp }}" style="width: 100%; height: 100%;">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI JUAL -->
 <div class="modal fade" id="modalConfirmSale" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle text-success mr-1"></i>
                    Konfirmasi Penjualan
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <p>
                    Apakah Anda yakin ingin memproses SPK ini sebagai
                    <strong>SOLD</strong>?
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
                                {{ $data->order_name }}
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
                    Setelah dikonfirmasi, SPK akan tercatat sebagai
                    <strong>SOLD</strong> dan masuk ke laporan penjualan.
                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    Batal
                </button>

                <form action="{{ route('spk.process-sale', $data->spk_no) }}"
                      method="POST"
                      id="formProcessSale">

                    @csrf

                    <button type="submit"
                            class="btn btn-success"
                            id="btnConfirmSale">
                        <i class="fas fa-check mr-1"></i>
                        Ya, Proses Penjualan
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>