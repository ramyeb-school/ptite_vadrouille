<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- include -->
    @include('resources.jquery')
    @include('resources.bootstrap')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/headerV2.css') }}">

</head>
<body>
    <video autoplay loop muted >
        <source src="ressources/videoFrance.mp4" type="video/mp4">
    </video>
    <nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="front"><img src="ressources/logovad.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        </ul>
        <span class="navbar-text">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="classement">Classement</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Aide</a>
                </li>
            </ul>
        </span>
    </div>
</nav>
        @yield('content')
    <script src="{{ asset('js/app.js') }}" defer></script>
    
</body>
</html>
