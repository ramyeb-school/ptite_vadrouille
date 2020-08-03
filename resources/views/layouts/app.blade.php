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
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <meta charset="utf-8">
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="{{ asset('js/france.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/MarkerCluster.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/MarkerCluster.Default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/map.css') }}">
    <title>Leaflet</title>
    <script type="text/javascript">
        var user = {!! json_encode($user) !!};
        var places_completed = {!! json_encode($places_completed) !!};
        var places_favorite = {!! json_encode($places_favorite) !!};
        var places = {!! json_encode($places) !!};
    </script>
</head>
<body>
    <div id="app">

        <nav class="navbarCustom">
            <div id="navbarLeft">
                <div id="navbarLeftTop">
                </div>
                <div id="navbarLeftBot">
                    
                    <a type="button" class="btn btn-outline-success btnFilter" id="doneFilterBtn">Complétés</a>
                    <a type="button" class="btn btn-outline-warning btnFilter" id="favFilterBtn">Favoris</a>
                    <a type="button" class="btn btn-light" href={{ route('classement') }}>Classement</a>
                </div>
            </div>
            <div id="navbarRight">
                <div id="navbarRightTop">
                    <h3>{{Auth::user()->nickname }}</h3>
                </div>
                <div id="navbarRightBot">
                   
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalCenter">Mon compte</button>
                    <button type="button" class="btn btn-light" 
                        href="{{ route('logout') }}"onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Déconnexion</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Mes information de compte</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <br>

            <h6>Pseudo : </h6>
            <input class="form-control" type="text" placeholder="{{Auth::user()->nickname }}" readonly>
            <br>

            <h6>Prénom : </h6>
            <input class="form-control" type="text" placeholder="{{Auth::user()->firstname }}" readonly>
            <br>


            <h6>Nom : </h6>
            <input class="form-control" type="text" placeholder="{{Auth::user()->lastname }}" readonly>
            <br>

            <h6>Email : </h6>
            <input class="form-control" type="text" placeholder="{{Auth::user()->email }}" readonly>
            <br>

            <h6>Description : </h6>
            <input class="form-control" type="text" placeholder="Désolé, la fonctionnalité n'est pas disponible pour le moment." readonly>
        </div>
      </div>
    </div>
  </div>

        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nickname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

            @yield('content')
    </div>
</body>
</html>
