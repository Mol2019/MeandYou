@extends('base.index',['title' => "Connexion"])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
@endsection

@section('app')
<div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{ route('login') }}" id="signup-form" class="signup-form">
                        @csrf
                        <h2 class="form-title">Espace connexion</h2>
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Email : ') }}</label>
                            <input value="{{ old('email') }}" id="email" type="email"  name="email" class="form-input @error('email') is-invalid @enderror" placeholder="Adresse email">
                            @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Mot de passe : ') }}</label>
                            <input id="password" type="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="Mot de passe" aria-label="Username" aria-describedby="basic-addon1" autocomplete="current-password">
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                            <label for="remember" class="label-agree-term"><span><span></span></span>{{ __('Se souvenir') }}</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Connexion"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Vous n'avez pas de compte ? <a href="{{ url('/register') }}" class="loginhere-link">Inscrivez vous</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
@endsection
