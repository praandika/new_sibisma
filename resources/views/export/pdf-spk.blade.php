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
                <div class="info-dealer">
                    <span style="font-weight: bold; font-size: 14px;">{{ $dealer->dealer_name }}</span><br>
                    <span style="font-size: 10px;">{{ $dealer->address }}</span>
                </div>
                <img src="img/semakin-didepan.png" alt="BISMA" width="150px" style="position: absolute; right: 0px;">
            </div>
        </div>
    </header>
    <!-- DATA SPK -->
    <div class="left">
        <center>
            <p class="title">SURAT PESANAN KENDARAAN (SPK)</p>
        </center>
        <table>
            <tr>
                <th>Tanggal</th>
                <td>: {{ \Carbon\Carbon::parse($data->spk_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Nama Pemesan</th>
                <td>: {{ $data->order_name }}</td>
            </tr>
            <tr>
                <th>KTP</th>
                <td>: {{ $data->ktp_number }}</td>
            </tr>
            <tr>
                <th>Alamat KTP</th>
                <td>: {{ $data->address }}</td>
            </tr>
            <tr>
                <th>Alamat Pengiriman</th>
                <td>: {{ $data->address_shipment }}</td>
            </tr>
            <tr>
                <th>No. Telp</th>
                <td>: {{ $data->spk_phone }}</td>
            </tr>
            <tr>
                <th>Nama STNK & BPKB</th>
                <td>: {{ $data->stnk_name }}</td>
            </tr>
            <tr>
                <th>Type Motor</th>
                <td>: {{ $data->model_name }}</td>
            </tr>
            <tr>
                <th>Warna Motor</th>
                <td>: {{ $data->faktur_color }} &nbsp; ( {{ $data->year_mc }} )</td>
            </tr>
            <tr>
                <th>Harga OTR</th>
                <td>: Rp {{ number_format($data->price, 0, ',','.') }}</td>
            </tr>
            <tr>
                <th>Uang Muka</th>
                <td>: Rp {{ number_format($data->downpayment, 0, ',','.') }}</td>
            </tr>
            <tr>
                <th>Potongan</th>
                <td>: Rp {{ number_format($data->discount, 0, ',','.') }}</td>
            </tr>
            <tr>
                <th>Tipe Pembayaran</th>
                <td>: {{ $data->payment_method }}</td>
            </tr>
            <tr>
                @if($data->payment_method == 'CASH')
                    <th>Microfinance</th>
                    <td>: {{ $data->microfinance }}</td>
                @else
                    <th>Finance</th>
                    <td>: {{ $data->leasing }} {{ $data->bunga }} {{ $data->tenor == '' ? $data->tenor : $data->tenor.' Bulan' }}</td>
                @endif
            </tr>
            <tr>
                <th>Salesman</th>
                <td>: {{ $data->manpower }}</td>
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
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Kelengkapan Data</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Closing DPACK</label>
            </div>

            <div class="cekbox-input" style="position: relative;">
                <input disabled type="checkbox" class="form-input" id="konfirmasiPembelian"> &nbsp;<label
                    for="konfirmasiPembelian" style="position: absolute; top: -1px">Berkas Samsat</label>
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

            <div style="width: 300px; height: 120px; border: 1px solid grey; padding-left: 5px;">&nbsp;{{ $data->deposit > 0 ? 'Tanda Jadi '.number_format($data->deposit, 0, ',','.') : '' }} <br>
            <span style="font-size: 8px !important;">{{ $data->description }}</span>
            </div>
        </div>
        <!-- END DATA SPK -->
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
