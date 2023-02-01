<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Signika Negative', sans-serif;
        }

    </style>
</head>

<body>
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
                    <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                        for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Konfirmasi Pembelian</label>
                </div>

                <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                    <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                        for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Konfirmasi Pengiriman |
                        Tgl_____________</label>
                </div>

                <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                    <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                        for="konfirmasiPembelian" style="position: relative; bottom: 1px;">PDI</label>
                </div>

                <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                    <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                        for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Valid Data
                        (KTP,KK,KIPEM)</label>
                </div>

                <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                    <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                        for="konfirmasiPembelian" style="position: relative; bottom: 1px;">DPACK</label>
                </div>

                <div class="cekbox-input" style="position: relative; margin-bottom: 15px;">
                    <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                        for="konfirmasiPembelian" style="position: relative; bottom: 1px;">Kepemilikan Motor</label>
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
                    class="form-control input-border-bottom" placeholder="Keterangan" value="{{ old('description') }}"
                    style="border: 1px dashed grey; padding: 10px;"></textarea>
            </div>

        </div>
        @empty
        <div class="col-md-12">
            <h3 style="text-align: center;">no data available</h3>
        </div>
        @endforelse
    </div>
</body>

</html>
