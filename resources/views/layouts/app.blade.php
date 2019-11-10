
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <i class="fas fa-copyright d-block mx-auto mb-4"></i>
    </div>

    @yield('content')

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Mintos</p>
        <ul class="list-inline">
            @if (\Illuminate\Support\Facades\Auth::guest())
                <li class="list-inline-item"><a href="{{route('login')}}">Login</a></li>
                <li class="list-inline-item"><a href="{{route('register')}}">Register</a></li>
            @else
                <li class="list-inline-item"><a href="{{route('home')}}">RSS Feed</a></li>
            @endif
        </ul>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
