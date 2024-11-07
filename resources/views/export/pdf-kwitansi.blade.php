<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
        }

        table tr th,
        table tr th {
            padding: 4px;
        }

        footer {
            margin-top: 20px;
            font-size: 9px;
        }

        header {
            font-size: 9px;
            border-bottom: 1px solid grey;
            padding-bottom: 5px;
        }

        .container-img {
            position: relative;
        }

        .container-img .info-dealer {
            position: absolute;
            top: -8px;
        }

        .container-logo {
            margin: auto;
            width: 100%;
        }

        .terbilang{
            float: left;
            width: 50%;
            margin-top: 50px;
            font-weight: bold;
        }
        .tandatangan{
            float: right;
            width: 50%;
            margin-top: 10px;
            text-align: right;
        }

        .data{
            margin-top: 60px;
        }

        /* Clear floats after the columns */
        .detail:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    @include('export.terbilang')

    <header>
        <div class="container-img">
            <div class="container-logo">
                <img src="img/logo-bisma.png" alt="BISMA" width="100px">
                &nbsp;
                @foreach($dealer as $a)
                <div class="info-dealer">
                    <span style="font-weight: bold; font-size: 14px;">{{ $a->dealer_name }}</span><br>
                    <span style="font-size: 10px;">{{ $a->address }} <br> {{ $a->phone }}</span>
                </div>
                @endforeach
                <img src="img/semakin-didepan.png" alt="BISMA" width="150px" style="position: absolute; right: 0px;">
            </div>
        </div>
    </header>
    <div class="row">
        <div class="data">
            <center>
                <p class="title">KWITANSI</p>
            </center>
            <table>
            @forelse($data as $o)
                <tr>
                    <th>No</th>
                    <td>: {{ $noKw }}</td>
                </tr>
                <tr>
                    <th>Sudah terima dari</th>
                    <td>: {{ $o->customer_name }}</td>
                </tr>
                <tr>
                    <th>Banyaknya uang</th>
                    <td>:   @if($o->payment_method == 'cash')
                                {{ terbilang($o->stock->unit->price - $o->discount) }}
                            @elseif($o->payment_method == 'credit')
                                {{ terbilang($o->downpayment - $o->discount) }}
                            @endif
                            Rupiah
                    </td>
                </tr>
                <tr>
                    <th width="150px">Untuk pembayaran</th>
                    <td> : @if($o->payment_method == 'credit') Uang muka @else Pelunasan @endif pembelian  1 (satu) unit Yamaha {{ $o->stock->unit->model_name }} warna {{ $o->stock->unit->color->color_faktur }}</td>
                </tr>
                <tr>
                    <th>Nomor Rangka</th>
                    <td>: {{ strtoupper($o->frame_no) }}</td>
                </tr>
                <tr>
                    <th>Nomor Mesin</th>
                    <td>: {{ strtoupper($o->engine_no) }}</td>
                </tr>
            @empty
            @endforelse
            </table>

            <div class="row detail">
                <div class="terbilang" style="padding-left: 30px;">
                    <div>
                        <table style="border-top: 5px double black; border-bottom: 5px double black; width: 400px;">
                            <tr>
                                <td style="padding: 10px 0 10px 0;">Terbilang Rp.</td>
                                <th>
                                    <span style="display: inline-block; border-top: 1px solid black; border-bottom: 1px solid black; margin-top: -5px; margin-bottom: -5px; margin-right: -100px; height: 35px; width: 200px; position: relative;">
                                            <span style="position: absolute; left: 50px; font-size: 20px;">
                                                @if($o->payment_method == 'cash')
                                                    {{ number_format($o->stock->unit->price - $o->discount) }}
                                                @elseif($o->payment_method == 'credit')
                                                    {{ number_format($o->downpayment - $o->discount) }}
                                                @endif
                                            </span>
                                    </span>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="tandatangan" style="padding-right: 30px;">
                    Denpasar, {{ Carbon\Carbon::parse($o->sale_date)->format('j F Y') }}
                </div>
            </div>
        </div>
    </div>

    <footer style="text-align: center;">
        &copy; Sibisma | Printed at {{ $printDate }} WITA
    </footer>

    <!-- PAGE DIVIDER -->
    <br><br><br>
    <span style="width: 100%; border: 1px dashed red; display: inline-block;"></span>
    <br><br><br>

    <header>
        <div class="container-img">
            <div class="container-logo">
                <img src="img/logo-bisma.png" alt="BISMA" width="100px">
                &nbsp;
                @foreach($dealer as $a)
                <div class="info-dealer">
                    <span style="font-weight: bold; font-size: 14px;">{{ $a->dealer_name }}</span><br>
                    <span style="font-size: 10px;">{{ $a->address }} <br> {{ $a->phone }}</span>
                </div>
                @endforeach
                <img src="img/semakin-didepan.png" alt="BISMA" width="150px" style="position: absolute; right: 0px;">
            </div>
        </div>
    </header>
    <div class="row">
        <div class="data">
            <center>
                <p class="title">KWITANSI</p>
            </center>
            <table>
            @forelse($data as $o)
                <tr>
                    <th>No</th>
                    <td>: {{ $noKw }}</td>
                </tr>
                <tr>
                    <th>Sudah terima dari</th>
                    <td>: {{ $o->customer_name }}</td>
                </tr>
                <tr>
                    <th>Banyaknya uang</th>
                    <td>:   @if($o->payment_method == 'cash')
                                {{ terbilang($o->stock->unit->price - $o->discount) }}
                            @elseif($o->payment_method == 'credit')
                                {{ terbilang($o->downpayment - $o->discount) }}
                            @endif
                            Rupiah
                    </td>
                </tr>
                <tr>
                    <th width="150px">Untuk pembayaran</th>
                    <td> : @if($o->payment_method == 'credit') Uang muka @else Pelunasan @endif pembelian  1 (satu) unit Yamaha {{ $o->stock->unit->model_name }} warna {{ $o->stock->unit->color->color_faktur }}</td>
                </tr>
                <tr>
                    <th>Nomor Rangka</th>
                    <td>: {{ strtoupper($o->frame_no) }}</td>
                </tr>
                <tr>
                    <th>Nomor Mesin</th>
                    <td>: {{ strtoupper($o->engine_no) }}</td>
                </tr>
            @empty
            @endforelse
            </table>

            <div class="row detail">
                <div class="terbilang" style="padding-left: 30px;">
                    <div>
                        <table style="border-top: 5px double black; border-bottom: 5px double black; width: 400px;">
                            <tr>
                                <td style="padding: 10px 0 10px 0;">Terbilang Rp.</td>
                                <th>
                                    <span style="display: inline-block; border-top: 1px solid black; border-bottom: 1px solid black; margin-top: -5px; margin-bottom: -5px; margin-right: -100px; height: 35px; width: 200px; position: relative;">
                                            <span style="position: absolute; left: 50px; font-size: 20px;">
                                                @if($o->payment_method == 'cash')
                                                    {{ number_format($o->stock->unit->price - $o->discount) }}
                                                @elseif($o->payment_method == 'credit')
                                                    {{ number_format($o->downpayment - $o->discount) }}
                                                @endif
                                            </span>
                                    </span>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="tandatangan" style="padding-right: 30px;">
                    Denpasar, {{ Carbon\Carbon::parse($o->sale_date)->format('j F Y') }}
                </div>
            </div>
        </div>
    </div>
    
    <footer style="text-align: center;">
        &copy; Sibisma | Printed at {{ $printDate }} WITA
    </footer>
</body>

</html>
