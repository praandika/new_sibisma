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
    <a href="{{ Auth::user()->access == 'salesman' ? route('spk.salesman') : route('spk.index') }}">Data SPK</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Show</a>
</li>
@endpush
    <!-- Status -->
    @foreach($data as $a)
    <div class="col-md-4">
        <div class="card card-dark bg-primary-gradient curves-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right"><img src="{{ asset('img/payment_method.png') }}" alt="payment method"></div>
                <h2 class="mb-2">{{ ucwords($a->payment_method) }}</h2>
                <p>Payment Method</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient skew-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right">
                    @if($a->credit_status == 'survey')
                    <img src="{{ asset('img/survey.png') }}" alt="Survey">
                    @elseif($a->credit_status == 'acc')
                    <img src="{{ asset('img/acc.png') }}" alt="Acc">
                    @elseif($a->credit_status == 'reject')
                    <img src="{{ asset('img/reject.png') }}" alt="Reject">
                    @else
                    <img src="{{ asset('img/cash.png') }}" alt="Cash">
                    @endif
                </div>
                <h2 class="mb-2">{{ ucwords($a->credit_status) }}</h2>
                <p>Credit Status</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-secondary-gradient bubble-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right">
                    @if($a->order_status == 'indent')
                    <img src="{{ asset('img/indent.png') }}" alt="Indent">
                    @else
                    <img src="{{ asset('img/available.png') }}" alt="Available">
                    @endif
                </div>
                <h2 class="mb-2">{{ ucwords($a->order_status) }}</h2>
                <p>Order Status</p>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END Status -->

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">{{ $spk_no }}</h4>
                </div>
                <div class="col-md-6" style="text-align: right;">
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
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($data as $o)
                <div class="col-md-6">
                    <center>
                        <h2>SURAT PESANAN KENDARAAN (SPK)</h2>
                    </center>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <th width="200">Tanggal</th>
                            <td>: {{ $o->spk_date }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama Pemesan</th>
                            <td>: {{ $o->order_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat</th>
                            <td>: {{ $o->customer_address }}</td>
                        </tr>
                        <tr>
                            <th width="200">No. Telp</th>
                            <td>: {{ $o->spk_phone }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama STNK & BPKB</th>
                            <td>: {{ $o->stnk_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Type Motor</th>
                            <td>: {{ $o->model_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Warna Motor</th>
                            <td>: {{ $o->color_faktur }}</td>
                        </tr>
                        <tr>
                            <th width="200">Harga OTR</th>
                            <td>: Rp {{ number_format($o->price, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Uang Muka</th>
                            <td>: Rp {{ number_format($o->downpayment, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Potongan</th>
                            <td>: Rp {{ number_format($o->discount, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Finance</th>
                            <td>: {{ $o->leasing_code }}</td>
                        </tr>
                        <tr>
                            <th width="200">Salesman</th>
                            <td>: {{ $o->salesman }}</td>
                        </tr>
                        <tr>
                            <th width="200">Keterangan</th>
                            <td>: {{ $o->description }}</td>
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
                            class="form-control input-border-bottom" placeholder="{{ $o->tandajadi > 0 ? 'Tanda Jadi '.number_format($o->tandajadi, 0, ',','.') : 'Keterangan' }}"
                            style="border: 1px dashed grey; padding: 10px;"></textarea>
                        
                            <div class="card" style="margin-top: 10px;">
                                <div class="card-body">
                                    <img src="{{ $o->ktp == '' ? asset('img/noimage.jpg') : asset('img/ktp/'.$o->ktp.'') }}" alt="{{ $o->ktp }}" style="width: 100%; height: 100%;">
                                </div>
                            </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <h3 style="text-align: center;">no data available</h3>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
