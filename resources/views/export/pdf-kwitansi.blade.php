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
            font-size: 14px;
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 5px;
        }

        table tr th,
        table tr th {
            padding: 5px 5px 5px 10px;
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

        .left{
            float: left;
            width: 10%;
        }

        .right{
            float: right;
            width: 90%;
        }

        .container-header{
            position: relative;
            height: 90%;
        }

        span.header{
            display: inline-block;
            transform: rotate(-90deg);
            position: absolute;
            bottom: 0px;
            top: 0px;
            left: 0px;
            right: -100px;
            text-align: center;
            word-wrap: break-word;
            width: 350px;
        }

        span.header .name{
            font-size: 25px;
            font-weight: bold;
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
            margin-top: 30px;
            text-align: right;
        }

    </style>
</head>

<body>
    <div class="row">
        <div class="left" style="border-right: 5px double black;">
        @foreach($dealer as $a)
        <div class="container-header">
            <span class="header">
                <span class="name">{{ $a->dealer_name }}</span> <br>
                {{ $a->address }} <br>
                {{ $a->phone }}
            </span>
        </div>
        @endforeach

        </div>
        <div class="right">
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
                    <td>:</td>
                </tr>
                <tr>
                    <th width="150px">Untuk pembayaran</th>
                    <td> :____________________________________________________________________________________________________</td>
                </tr>
                <tr>
                    <th width="150px"></th>
                    <td> &nbsp;____________________________________________________________________________________________________</td>
                </tr>
                <tr>
                    <th>Nomor Rangka</th>
                    <td>: {{ $o->frame_no }}</td>
                </tr>
                <tr>
                    <th>Nomor Mesin</th>
                    <td>: {{ $o->engine_no }}</td>
                </tr>
            @empty
            @endforelse
            </table>

            <div class="row">
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

    <footer>
        <span>
            &copy; Sibisma | 
        </span>
        <span>
            Printed at {{ $printDate }} WITA
        </span>
    </footer>
</body>

</html>
