<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK {{ $spk_no }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 5px;
        }

        table tr th,
        table tr th {
            padding: 2px;
        }

        .left {
            float: left;
            width: 50%;
            margin-top: 50px;
        }

        .right {
            float: right;
            text-align: left;
            width: 50%;
            margin-top: 50px;
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            font-size: 9px;
        }

        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            font-size: 9px;
            border-bottom: 1px solid grey;
            padding-bottom: 5px;
        }

        .container-img {
            position: relative;
        }

        .container-img .info-dealer {
            position: absolute;
            top: -1px;
        }

        .container-logo {
            margin: auto;
            width: 100%;
        }

    </style>
</head>

<body>
    <header>
        <div class="container-img">
            <div class="container-logo">
                <img src="img/logo-bisma.png" alt="BISMA" width="100px">
                &nbsp;
                @foreach($dealer as $a)
                <div class="info-dealer">
                    <span style="font-weight: bold; font-size: 14px;">{{ $a->dealer_name }}</span><br>
                    <span style="font-size: 10px;">{{ $a->address }}</span>
                </div>
                @endforeach
                <img src="img/semakin-didepan.png" alt="BISMA" width="150px" style="position: absolute; right: 0px;">
            </div>
        </div>
    </header>
    @forelse($data as $o)
    <div class="left">
        <center>
            <p class="title">SURAT PESANAN KENDARAAN (SPK)</p>
        </center>
        <table>
            <tr>
                <th>Tanggal</th>
                <td>: {{ \Carbon\Carbon::parse($o->spk_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Nama Pemesan</th>
                <td>: {{ $o->order_name }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: {{ $o->customer_address }}</td>
            </tr>
            <tr>
                <th>No. Telp</th>
                <td>: {{ $o->customer_phone }}</td>
            </tr>
            <tr>
                <th>Nama STNK & BPKB</th>
                <td>: {{ $o->stnk_name }}</td>
            </tr>
            <tr>
                <th>Type Motor</th>
                <td>: {{ $o->stock->unit->model_name }}</td>
            </tr>
            <tr>
                <th>Warna Motor</th>
                <td>: {{ $o->stock->unit->color->color_faktur }} &nbsp; ( {{ $o->stock->unit->year_mc }} )</td>
            </tr>
            <tr>
                <th>Harga OTR</th>
                <td>: Rp {{ number_format($o->stock->unit->price, 0, ',','.') }}</td>
            </tr>
            <tr>
                <th>Uang Muka</th>
                <td>: Rp {{ number_format($o->downpayment, 0, ',','.') }}</td>
            </tr>
            <tr>
                <th>Potongan</th>
                <td>: Rp {{ number_format($o->discount, 0, ',','.') }}</td>
            </tr>
            <tr>
                <th>Finance</th>
                <td>: {{ $o->leasing_code }}</td>
            </tr>
            <tr>
                <th>Salesman</th>
                <td>: {{ $o->manpower->name }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>: {{ $o->description }}</td>
            </tr>
        </table>
    </div>
    <div class="right" style="font-size: 11px;">
        <center>
            <p class="title">FORM SPK Processing</p>
        </center>
        <div class="cekbox-container" style="padding-left: 30px;">
            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Konfirmasi Pembelian</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Konfirmasi Pengiriman |
                    Tgl_____________</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">PDI</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Valid Data
                    (KTP,KK,Domisili)</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">DPACK</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Kepemilikan Motor</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Faktur |
                    Tgl_____________</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Tagihan Leasing |
                    Tgl_____________</label>
            </div>
            <br>
            <label for="description">Keterangan:</label>

            <div style="width: 300px; height: 120px; border: 1px solid grey;">&nbsp;{{ $o->tandajadi > 0 ? 'Tanda Jadi '.number_format($o->tandajadi, 0, ',','.') : '' }}</div>
        </div>
        @empty
        <div class="col-md-12">
            <h3 style="text-align: center;">no data available</h3>
        </div>
        @endforelse
    </div>
    <footer>
        <div style="float: right; width: 50%; font-size: 8px;">
            {{ $spk_no }} | &copy; Sibisma
        </div>
        <div style="float: left; width: 50%; text-align: right; font-size: 8px;">
            Printed at {{ $printDate }} WITA &nbsp;
        </div>
    </footer>
</body>

</html>
