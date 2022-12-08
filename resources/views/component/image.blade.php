<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detail stock @forelse($data as $b){{ $b->model_name }} @empty Image @endforelse" />
    <meta property="og:title" content="@forelse($data as $b){{ $b->model_name }} Image @empty Image @endforelse" />
    <meta property="og:url" content="https://127.0.0.1:8000/search/@forelse($data as $b){{ $b->image }} @empty image @endforelse" />
    <meta property="og:description" content="Detail stock @forelse($data as $b){{ $b->model_name }} @empty Image @endforelse" />
    <meta property="og:image" content="https://127.0.0.1:8000/img/motorcycle/@forelse($data as $b){{ $b->image }} @empty image @endforelse" />
    <link rel="icon" href="@forelse($data as $a){{ asset('img/motorcycle/'.$a->image.'') }}@empty{{ asset('img/icon-sibisma.png') }}@endforelse" type="image/x-icon"/>
    <title>@forelse($data as $a) {{ $a->model_name }} Image @empty Image @endforelse | Yamaha Bisma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Staatliches', cursive;
        }

        .container{
            margin: auto;
            text-align: center;
        }

        .container p{
            font-size: 40px;
        }

        .container img{
            max-width: 100%;
            height: auto;
        }

        footer p{
            text-align: center;
        }

        footer a{
            text-decoration: none;
            color: grey;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('img/new-sibisma-login-2.png') }}" alt="">
        <hr>
        @forelse($data as $o)
        <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="{{ $o->model_name }}">
        <p>
            {{ $o->model_name }}
            <br>
            {{ $o->color->color_name }}
        </p>
        @empty
        <p>No Image Available</p>
        @endforelse
    </div>
    <hr>
    <footer>
        <p>&copy;CRM Bisma Group | Developed by <a href="https://dikaprana.com" target="_blank">dikaprana.com</a></p>
    </footer>
</body>
</html>