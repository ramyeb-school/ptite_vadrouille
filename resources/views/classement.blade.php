
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/headerV2.css') }}">
    <link href="{{ asset('css/classement.css') }}" rel="stylesheet">


</head>
<body>

  
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
                      <a class="nav-link" href="#">Aide</a>
                  </li>
                  @guest
                  <li class="nav-item">
                    <a class="nav-link" href="login">Connexion</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="register">Inscription</a>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="home">Retour à la carte</a>
                  </li>
                @endguest
              </ul>
          </span>
      </div>
  </nav>    


    <div class="container" id="entete">
            <h3>La crème de la vadrouille !
            <div id="underline"></div>

            </h3>
    </div>


    
    <div class="container podium-container">
      <div class="podium">
        <div id="podium-deux">
          <h3><?php 
            if( isset($infosUsers[1]) )
              echo $infosUsers[1]["nickname"];
            else
              echo "...";
              ?></h3>
          <div class="marche">
            <p>2</p>
          </div>
        </div>
        <div id="podium-un">
          <h3><?php 
            if( isset($infosUsers[0]) )
              echo $infosUsers[0]["nickname"];
            else
              echo "...";
              ?></h3>
          <div class="marche">
            <p>1</p>
          </div>
        </div>
        <div id="podium-trois">
          <h3><?php 
          if( isset($infosUsers[2]) )
            echo $infosUsers[2]["nickname"];
          else
            echo "...";
            ?></h3>
          <div class="marche">
            <p>3</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container" id="squeletteTable">
        <table class="table">
            <tbody>
            <?php $i = 1; ?>
            @foreach ($infosUsers as $item)
            <tr id='first-tr'>
              <th scope="row" class="photo"><?php echo $i; $i++;?></th>
              <td class="name">{{ $item["nickname"] }}</td>
              <td  class="progression">
                  <div class="progress">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: {{ fmod ( $item["experience"], 100 )}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"> XP : {{ fmod( $item["experience"], 100) }}/100</div>
                  </div>
              </td>
              <td>Niv' {{ ($item["experience"] - fmod( $item["experience"], 100))/100}}</td>
            </tr>
            @endforeach

            
            </tbody>
        </table>
    </div>
</body>
</html>
 