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

        table tr th,
        table tr th {
            padding: 2px;
        }
    </style>
</head>

<body>
    <center>
    @forelse($data as $o)
        <table>
            <tr>
                <td>
                    <img src="img/ktp/{{ $o->ktp }}" alt="{{ $o->ktp }}" style="width: 321px; height: 207px">
                </td>
                <td>
                    <img src="img/ktp/{{ $o->ktp }}" alt="{{ $o->ktp }}" style="width: 321px; height: 207px">
                </td>
            </tr>
            <tr>
                <td>
                    <img src="img/ktp/{{ $o->ktp }}" alt="{{ $o->ktp }}" style="width: 321px; height: 207px">
                </td>
                <td>
                    <img src="img/ktp/{{ $o->ktp }}" alt="{{ $o->ktp }}" style="width: 321px; height: 207px">
                </td>
            </tr>
        </table>
    @empty
        <p>No Image Available</p>
    @endforelse
    </center>
</body>

</html>
