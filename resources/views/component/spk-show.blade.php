@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Show SPK')
@section('page-title','Show SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">Data SPK</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">{{ $spk_no }}</h4>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <a href="{{ url('spk-print/',$spk_no) }}" class="btn btn-primary btn-round" style="margin-bottom: 20px;"><i class="fas fa-print"></i>&nbsp;&nbsp; <strong>Print</strong> </a>
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
                            <td>: {{ $o->address }}</td>
                        </tr>
                        <tr>
                            <th width="200">No. Telp</th>
                            <td>: {{ $o->phone }}</td>
                        </tr>
                        <tr>
                            <th width="200">Nama STNK & BPKB</th>
                            <td>: {{ $o->stnk_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Type Motor</th>
                            <td>: {{ $o->stock->unit->model_name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Harga OTR</th>
                            <td>: Rp {{ number_format($o->stock->unit->price, 0, ',','.') }}</td>
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
                            <th width="200">Pembayaran</th>
                            <td>: Rp {{ number_format($o->payment, 0, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th width="200">Finance</th>
                            <td>: {{ $o->leasing_code }}</td>
                        </tr>
                        <tr>
                            <th width="200">Salesman</th>
                            <td>: {{ $o->manpower->name }}</td>
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
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Konfirmasi Pembelian</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Konfirmasi Pengiriman | Tgl_____________</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">PDI</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Valid Data (KTP,KK,KIPEM)</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">DPACK</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Kepemilikan Motor</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Faktur | Tgl_____________</label>
                        </div>

                        <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                            <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Tagihan Leasing | Tgl_____________</label>
                        </div>

                        <textarea name="description" id="description" cols="30" rows="10" class="form-control input-border-bottom" placeholder="Keterangan" value="{{ old('description') }}" style="border: 1px dashed grey; padding: 10px;"></textarea>
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
