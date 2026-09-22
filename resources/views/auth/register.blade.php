<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription | CODIR App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body themebg-pattern="theme1">

    <!-- Pre-loader -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="gap-patch"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <form class="md-float-material form-material" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="text-center">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                        </div>

                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">S'inscrire</h3>
                                    </div>
                                </div>

                                {{-- Nom --}}
                                <div class="form-group form-primary">
                                    <input type="text" name="nom" value="{{ old('nom') }}" class="form-control @error('nom') is-invalid @enderror" required>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Nom</label>
                                    @error('nom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Prénoms --}}
                                <div class="form-group form-primary">
                                    <input type="text" name="prenoms" value="{{ old('prenoms') }}" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Prénoms</label>
                                </div>

                                {{-- Fonction --}}
                                <div class="form-group form-primary">
                                    <input type="text" name="fonction" value="{{ old('fonction') }}" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Fonction</label>
                                </div>

                                {{-- Contact --}}
                                <div class="form-group form-primary">
                                    <input type="text" name="contact" value="{{ old('contact') }}" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Contact</label>
                                </div>

                                {{-- Email --}}
                                <div class="form-group form-primary">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required oninput="this.value = this.value.toLowerCase()">
                                    <span class="form-bar"></span>
                                    <label class="float-label" for="email">Adresse e-mail</label>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Password et confirmation --}}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="password">Mot de passe</label>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                                            <span class="form-bar"></span>
                                            <label class="float-label">Confirmer le mot de passe</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- CGU --}}
                                <div class="row m-t-25 text-left">
                                    <div class="col-md-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" name="cgu" required>
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">J'accepte les <a href="#">Conditions Générales</a></span>
                                            </label>
                                            @error('cgu')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Bouton --}}
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                            S'inscrire maintenant
                                        </button>
                                    </div>
                                </div>

                                <hr/>

                                {{-- Footer --}}
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">
                                            Déjà inscrit ? <a href="{{ route('login') }}"><b>Connectez-vous</b></a>
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('assets/images/auth/Logo-small-bottom.png') }}" alt="Small Logo">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- JS -->
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/pages/waves/js/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/common-pages.js') }}"></script>

</body>
</html>
