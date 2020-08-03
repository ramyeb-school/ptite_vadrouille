

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
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="{{ asset('js/france.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/front.css') }}">
</head>

<body>

        <video autoplay loop muted >
            <source src="ressources/videoFrance.mp4" type="video/mp4">
        </video>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="/"><img src="ressources/logovad.png"></a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="login">Connexion</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="register">Inscription</a>
                        </li>
                    </ul>
                </span>
            </div>
        </nav>    


        <div id="titre">
            Completez la carte en parcourant 
            <div id="mot">
                <span>le Val d'Oise.</span>
                <span>l'Ain.</span>
                <span>la Corse.</span>
                <span>le Jura.</span>
                <span>la Savoie.</span>
                <span>Paris !</span>
                <span>la Vendée.</span>
                <span>la Gironde.</span>
                <span>les Yvelines.</span>
            </div>
        </div>




        <footer></footer>
        <img id="france-img"
        src="ressources/Carte_France.png">

</body>

</html>


