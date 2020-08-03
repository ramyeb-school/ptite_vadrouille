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

  <div class="vertical-center">

    <div class="container ">
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto ">
                <div id="swup" class="transition-fade" >
    
                <div class="card ">
                    <div class="register">
                        <div class="card-header">
                            <h3 class="row justify-content-center">Ajout d'une place</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="col-lg-11 mx-auto col-lg-offset-1">
                                <form id="formulaire" method="POST" action="{{ route('Place.create') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Nom</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nom de la place" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>
                                        <div class="col-md-6">
                                          <label for="type">Type</label>
                                          <input type="text" id="type" name="type" class="form-control" placeholder="Type" value="{{ old('type') }}" required autocomplete="type" autofocus>
                                        </div>
                                    </div>
                                    <div class="row">
    
                                      <div class="col-md-6">
                                        <label for="lng">longitude</label>
                                        <input type="text" id="lng" name="lng" class="form-control" placeholder="longitude" value="{{ old('lng') }}" required autocomplete="lng" autofocus>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="lat">Latitude</label>
                                        <input type="text" id="lat" name="lat" class="form-control" placeholder="Latitude" value="{{ old('lat') }}" required autocomplete="lat" autofocus>
                                      </div>

                                    </div>
                                    <div class="row">
    
                                      <div class="col-md-6">
                                        <label for="adr">Adresse</label>
                                        <input type="text" id="adr" name="adr" class="form-control" placeholder="Adresse" value="{{ old('adr') }}" required autocomplete="adr" autofocus>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="dep">Departement</label>
                                        <input type="text" id="dep" name="dep" class="form-control" placeholder="Departement" value="{{ old('dep') }}" required autocomplete="dep" autofocus>
                                      </div>

                                    </div>
                                    <div class="row">
                                      <div class="custom-file">
                                        <input type="file" id="img" name="img" class="custom-file-input" id="validatedCustomFile" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Image...</label>
                                      </div>
                                      </div>

                                     

                                  
                                    </div>
                                    <div class="row">
                                        <div class="mx-auto">
                                            <input type="submit" class="btn" value="Let's go">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    

</body>
</html>
 