<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Order</title>
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
            margin-top: 35px;
            text-align: center;
        }

        table tr th,
        table tr th {
            padding: 5px;
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
            top: -7px;
        }

        .container-logo {
            margin: auto;
            width: 100%;
        }

        .left{
            float: left;
            width: 50%;
        }

        .right{
            float: right;
            width: 50%;
        }

        .tandatangan{
            text-align: center;
        }

        .tbKelengkapan{
            border: 1px solid black;
            width: 100%;
        }

        .tbKelengkapan tr td,
        .tbKelengkapan tr th{
            padding: 5px;
        }

        .centang{
            width: 8px;
            height: 8px;
            border: 1px solid black;
            display: inline-block;
        }
    </style>
</head>

<body>
    <header>
        <div class="container-img">
            <div class="container-logo">
                <img src="img/logo-bisma.png" alt="BISMA" width="60px">
                &nbsp;
                @foreach($dealer as $a)
                <div class="info-dealer">
                    <span style="font-weight: bold; font-size: 12px;">{{ $a->dealer_name }}</span><br>
                    <span style="font-size: 10px;">{{ $a->address }}</span>
                </div>
                @endforeach
                <img src="img/semakin-didepan.png" alt="BISMA" width="110px" style="position: absolute; right: 0px;">
            </div>
        </div>
    </header>
    @forelse($data as $o)
        <div class="title">DELIVERY ORDER (DO)</div>
        Kepada Yth. <br>
        {{ $o->customer_name }} <br>
        {{ $o->address }} <br>
        {{ $o->phone }} <br>
        di- <br>
        <p style="text-indent: 30px;">Tempat</p>
        <span display: block; margin-bottom: -10px;">Dengan Hormat, </span>
        <br>
        <span display: block;">Mohon diterima 1 unit kendaraan sesuai dengan identitas dibawah ini:</span>

        <br>

        <table>
            <tr>
                <th>Jenis</th>
                <td>: {{ $o->stock->unit->model_name }}</td>
            </tr>
            <tr>
                <th>Warna</th>
                <td>: {{ $o->stock->unit->color->color_name }}</td>
            </tr>
            <tr>
                <th>Nomor Rangka</th>
                <td>: {{ $o->frame_no }}</td>
            </tr>
            <tr>
                <th>Nomor Mesin</th>
                <td>: {{ $o->engine_no }}</td>
            </tr>
        </table>

        <table class="tbKelengkapan">
            <tr>
                <th colspan="4" style="text-align: center;">Perlengkapan</th>
            </tr>
            <tr>
                <td><span class="centang"></span> Unit</td>
                <td><span class="centang"></span> Helm</td>
                <td><span class="centang"></span> Cover Plat</td>
                <td><span class="centang"></span> Jaket</td>
            </tr>
            <tr>
                <td><span class="centang"></span> Remote SKS <span style="color: red;">*</span></td>
                <td><span class="centang"></span> Pin Remote <span style="color: red;">*</span></td>
                <td colspan="2"><span class="centang"></span> Kunci Emergency <span style="color: red;">*</span></td>
            </tr>
            <tr>
                <td colspan="4"> <br>
                    Lain-lain :...........................................................</td>
            </tr>
        </table>

        <p style="color: red;">* hanya tipe keyless</p>

        <p>Demikian <i>Delivery Order</i> ini, atas kerjasama Bapak/Ibu kami ucapkan terima kasih</p>

        <hr>

        <div class="tandatangan">
            <div class="left">
                <p>Denpasar, _________________</p>
                <p>Diterima Oleh,</p>
                <br><br><br>
                <p>(_________________________)</p>
            </div>
            <div class="right">
                <p>Denpasar, _________________</p>
                <p>Hormat Kami,</p>
                <br><br><br>
                <p>( {{ $o->stock->dealer->dealer_name }} )</p>
            </div>
        </div>
    @empty
        <center>
            No Data Available
        </center>
    @endforelse

    <footer>
        <div style="float: right; width: 50%; font-size: 8px;">
            &copy; Sibisma
        </div>
        <div style="float: left; width: 50%; text-align: right; font-size: 8px;">
            Printed at {{ $printDate }} WITA
        </div>
    </footer>
</body>

</html>
