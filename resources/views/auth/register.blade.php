@extends('layouts.appAuth')

@section('content')


<div class="vertical-center">

<div class="container ">
        <div class="col-sm-12 col-md-8 col-lg-6 mx-auto ">
            <div id="swup" class="transition-fade" >

            <div class="card ">
                <div class="register">
                    <div class="card-header">
                        <h3 class="row justify-content-center">Inscription</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-11 mx-auto col-lg-offset-1">
                            <form id="formulaire" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="firstname">Prénom</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="Harry" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastname">Nom</label>
                                        <input type="text" id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Potter" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label for="nickname">Identifiant</label>
                                        <input id="nickname" type="text"  name="nickname" class="form-control @error('nickname') is-invalid @enderror" placeholder="HarryDu95160" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>
                                        @error('nickname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Harry@poudlard.com" value="{{ old('email') }}" required autocomplete="email">

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
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Ça nous regarde pas.." required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <label for="password-confirm">Confirmez votre mot de passe</label>
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirmation" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="mx-auto">
                                        <input type="submit" class="btn" value="Let's go">
                                    </div>
                                </div>
                                <a class="nav-link mx-auto" href="{{ route('login') }}">Déjà inscrit ? Connecte toi !</a>
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
