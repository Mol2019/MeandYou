@extends('base.index',["title" => "Inscription"])

@section('styles')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endsection


@section('app')

        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="{{ asset('assets/images/form-img.jpg') }}" alt="">
                    <div class="signup-img-content">
                        <h2>Inscrivez vous maintenant </h2>
                         <p>
                             Vous êtes déjà membre ?
                             <a href="{{ url('/login') }}" class="btn btn-info">Connectez vous svp</a>
                        </p>
                    </div>
                </div>
                <div class="signup-form">
                    <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="photo">Photo</label>
                                    <input class="form-control" type="file" name="photo" id="photo" value="{{ old('photo') }}"/>
                                    @error('photo')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="nom" class="required">NOM</label>
                                    <input class="form-control" type="text" name="nom" id="nom" value="{{ old('nom') }}"/>
                                    @error('nom')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="prenoms" class="required">Prénom(s)</label>
                                    <input class="form-control" type="text" name="prenoms" id="prenoms" value="{{ old('prenoms') }}"/>
                                    @error('prenoms')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="email" class="required">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}"/>
                                    @error('email')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="contact1" class="required">Numéro de téléphone 1 </label>
                                    <input class="form-control" type="text" name="contact1" id="contact1" value="{{ old('contact1') }}"/>
                                    @error('contact1')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="contact2" class="required">Numéro de téléphone 2 </label>
                                    <input class="form-control" type="text" name="contact2" id="contact2" value="{{ old('contact2') }}"/>
                                    @error('contact2')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="date2naissance" class="required">Date de naissance</label>
                                    <input class="form-control" type="date" name="date2naissance" id="date2naissance" value="{{ old('date2naissance') }}"/>
                                    @error('date2naissance')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-select">
                                    <div class="label-flex">
                                        <label for="residence" class="required">Pays de résidence</label>
                                    </div>
                                    <div class="select-list">
                                        <select class="form-control" name="residence" id="residence">
                                                <option value="">Selectionnez votre lieu de residence</option>
                                            @foreach($residences as $residence)
                                                <option value="{{ $residence->id }}">{{ $residence->pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('residence')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="perfect_money" class="required">N° Perfect money</label>
                                    <input class="form-control" type="text" name="perfect_money" id="perfect_money" value="{{ old('perfect_money') }}"/>
                                     @error('perfect_money')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="password" class="required">Mot de passe</label>
                                    <input class="form-control" type="password" name="password" id="password" />
                                    @error('password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="password-confirm" class="required">Confirmation mot de passe</label>
                                    <input class="form-control" id="password-confirm" type="password" name="password_confirmation" />
                                </div>
                            </div>
                            <input type="hidden" name="lien_parainage" value="{{ $link ?? "" }}">
                        </div>

                        <div class="form-submit">
                            <input type="submit" value="Valider" class="submit" id="submit" name="submit" />
                            <input type="reset" value="Anuler" class="submit" id="reset" name="reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection


@section('scripts')
     <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
     <script src="{{ asset('assets/js/register.js') }}"></script>
@endsection

