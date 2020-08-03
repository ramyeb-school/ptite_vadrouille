@extends('layouts.appAuth')

@section('content')    

<div class="vertical-center">

<div class="container ">
        <div class="col-sm-12 col-md-8 col-lg-6 mx-auto ">
            <div id="swup" class="transition-fade" >

            <div class="card ">
                <div class="register">
                    <div class="card-header">
                        <h3 class="row justify-content-center">Connexion</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-11 mx-auto col-lg-offset-1">
                            <form id="formulaire" method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Ça nous regarde pas.." required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="mx-auto">
                                        <input type="submit" class="btn" value="Let's go">
                                    </div>
                                </div>
                                    <a class="nav-link mx-auto" href="{{ route('register') }}">Pas encore inscrit ? On est déçu !</a>
                                {{-- <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Se souvenir</label>
                                        </div>
                                    </div>
                                </div>
                                
                                 @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
