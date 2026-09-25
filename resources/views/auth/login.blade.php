<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Connexion à Comigest — plateforme de pilotage et de gestion du Comité de Direction.">
    <title>Connexion — Comigest</title>
    <link rel="icon" href="{{ asset(config('ipcs.logo')) }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/codir-modern.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <style>
        .login-page{min-height:100vh;display:grid;grid-template-columns:1.05fr .95fr;background:#f5f8fc;overflow:hidden}
        .login-showcase{position:relative;display:flex;align-items:center;padding:70px clamp(35px,7vw,100px);background:linear-gradient(145deg,#0618a8 0%,#102db4 58%,#f39a00 150%);color:#fff;overflow:hidden}
        .login-showcase:before,.login-showcase:after{content:"";position:absolute;border-radius:50%;pointer-events:none}
        .login-showcase:before{width:520px;height:520px;right:-230px;top:-190px;background:rgba(255,255,255,.09)}
        .login-showcase:after{width:430px;height:430px;left:-270px;bottom:-230px;background:rgba(19,184,200,.16)}
        .login-showcase-inner{position:relative;z-index:2;max-width:610px}
        .login-brand{display:inline-flex;align-items:center;gap:12px;text-decoration:none;color:#fff;margin-bottom:55px}
        .login-brand-mark{width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.22);display:grid;place-items:center;font:800 21px 'Manrope';box-shadow:0 12px 30px rgba(0,0,0,.12)}
        .login-brand-name{font:800 19px 'Manrope';letter-spacing:-.02em}.login-brand-name small{display:block;font:500 10px 'DM Sans';opacity:.72;letter-spacing:.05em;text-transform:uppercase;margin-top:2px}
        .login-showcase h1{color:#fff;font:800 clamp(36px,4.2vw,58px) 'Manrope';line-height:1.04;letter-spacing:-.045em;margin:0 0 20px;max-width:570px}
        .login-showcase h1 span{color:#9cf2f4}.login-showcase p{color:#dce9fb;font-size:15px;line-height:1.75;max-width:520px;margin:0 0 35px}
        .login-features{display:grid;gap:13px}.login-feature{display:flex;align-items:center;gap:12px;color:#e7f0fd;font-size:13px;font-weight:600}.login-feature i{width:30px;height:30px;border-radius:9px;background:rgba(255,255,255,.12);display:grid;place-items:center;color:#9cf2f4}
        .login-copyright{position:absolute;left:clamp(35px,7vw,100px);bottom:25px;color:rgba(255,255,255,.58);font-size:11px;z-index:2}
        .login-panel{display:flex;align-items:center;justify-content:center;padding:35px 28px;background:#fff}
        .login-form-wrap{width:min(430px,100%)}
        .login-mobile-brand{display:none;align-items:center;gap:10px;color:#10233f;text-decoration:none;margin-bottom:35px}
        .login-mobile-brand .mark{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#155eef,#13b8c8);display:grid;place-items:center;color:#fff;font:800 17px 'Manrope'}
        .login-eyebrow{font-size:11px;text-transform:uppercase;letter-spacing:.13em;font-weight:800;color:#155eef;margin-bottom:8px}.login-title{font:800 31px 'Manrope';letter-spacing:-.035em;color:#10233f;margin:0 0 8px}.login-subtitle{color:#718096;font-size:13px;margin:0 0 28px}
        .login-alert{padding:12px 14px;border-radius:12px;background:#ecfdf3;color:#087443;font-size:12px;margin-bottom:18px}
        .login-field{margin-bottom:18px}.login-label{display:flex;justify-content:space-between;align-items:center;font-size:12px;font-weight:800;color:#425269;margin-bottom:8px}.login-input-wrap{position:relative}.login-input{width:100%;height:48px;border:1px solid #dce5ef;border-radius:12px;background:#fbfcfe;padding:0 45px 0 43px;outline:0;font:500 13px 'DM Sans';color:#10233f;transition:.2s}.login-input:focus{border-color:#8fb5ff;background:#fff;box-shadow:0 0 0 4px #eaf2ff}.login-input-icon{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:#8a99ab;font-size:15px}.login-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);border:0;background:transparent;color:#8a99ab;cursor:pointer;width:28px;height:28px}.login-toggle:hover{color:#155eef}.login-error{font-size:11px;color:#d92d20;margin-top:6px}.login-options{display:flex;align-items:center;justify-content:space-between;gap:15px;margin:5px 0 22px}.login-check{display:flex;align-items:center;gap:8px;color:#66758a;font-size:12px;cursor:pointer}.login-check input{accent-color:#155eef}.login-forgot{color:#155eef;text-decoration:none;font-size:12px;font-weight:700}.login-forgot:hover{text-decoration:underline}.login-submit{width:100%;height:49px;border:0;border-radius:12px;background:linear-gradient(135deg,#155eef,#0b73e7);color:#fff;font:800 13px 'DM Sans';cursor:pointer;box-shadow:0 12px 25px rgba(21,94,239,.22);transition:.2s}.login-submit:hover{transform:translateY(-1px);box-shadow:0 15px 28px rgba(21,94,239,.27)}.login-divider{display:flex;align-items:center;gap:12px;margin:27px 0 20px;color:#a0adbd;font-size:10px}.login-divider:before,.login-divider:after{content:"";height:1px;background:#e8edf3;flex:1}.login-back{text-align:center;color:#718096;font-size:12px}.login-back a{color:#10233f;font-weight:800;text-decoration:none}.login-back a:hover{color:#155eef}.login-secure{display:flex;align-items:center;justify-content:center;gap:7px;color:#9aa7b7;font-size:10px;margin-top:25px}.login-secure i{color:#12b76a}

        .ipcs-login-logo{background:#fff!important;border-color:rgba(255,255,255,.3)!important;padding:5px;overflow:hidden}.ipcs-login-logo img{width:86px;height:46px;object-fit:contain}.login-mobile-brand img{width:76px;height:36px;object-fit:contain;border-radius:7px}.login-mobile-brand strong{font-size:14px}
        @media(max-width:900px){.login-page{grid-template-columns:1fr}.login-showcase{display:none}.login-panel{min-height:100vh;padding:30px 22px}.login-mobile-brand{display:flex}.login-form-wrap{width:min(430px,100%)}}
        @media(max-width:480px){.login-panel{padding:25px 18px}.login-title{font-size:27px}.login-options{align-items:flex-start;flex-direction:column;gap:12px}.login-mobile-brand{margin-bottom:28px}}
    </style>
</head>
<body>
<div class="login-page">
    <section class="login-showcase">
        <div class="login-showcase-inner">
            <a href="{{ url('/') }}" class="login-brand">
                <span class="login-brand-mark ipcs-login-logo"><img src="{{ asset(config('ipcs.logo')) }}" alt="IPCS"></span>
                <span class="login-brand-name">IPCS · Comigest<small>Espace de pilotage interne</small></span>
            </a>
            <h1>Pilotez {{ config('ipcs.name') }} avec <span>plus de clarté.</span></h1>
            <p>Retrouvez au même endroit les réunions CODIR, activités, tâches, obligations, livrables, clients et indicateurs de pilotage d’IPCS.</p>
            <div class="login-features">
                <div class="login-feature"><i class="fa fa-check"></i><span>Centralisez les informations du CODIR</span></div>
                <div class="login-feature"><i class="fa fa-check"></i><span>Suivez les actions et responsabilités</span></div>
                <div class="login-feature"><i class="fa fa-check"></i><span>Accédez à vos données depuis une interface moderne</span></div>
            </div>
        </div>
        <div class="login-copyright">© {{ date('Y') }} {{ config('ipcs.name') }} · {{ config('ipcs.platform') }}</div>
    </section>

    <main class="login-panel">
        <div class="login-form-wrap">
            <a href="{{ url('/') }}" class="login-mobile-brand"><img src="{{ asset(config('ipcs.logo')) }}" alt="IPCS"><strong>IPCS · Comigest</strong></a>
            <div class="login-eyebrow">IPCS · Espace sécurisé</div>
            <h2 class="login-title">Bienvenue</h2>
            <p class="login-subtitle">Connectez-vous à votre espace de pilotage.</p>

            @if (session('status'))
                <div class="login-alert"><i class="fa fa-check-circle"></i> {{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-field">
                    <label class="login-label" for="email">Adresse e-mail</label>
                    <div class="login-input-wrap">
                        <i class="fa fa-envelope-o login-input-icon"></i>
                        <input id="email" name="email" type="email" class="login-input" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nom@entreprise.com">
                    </div>
                    @error('email')<div class="login-error">{{ $message }}</div>@enderror
                </div>

                <div class="login-field">
                    <label class="login-label" for="password">Mot de passe</label>
                    <div class="login-input-wrap">
                        <i class="fa fa-lock login-input-icon"></i>
                        <input id="password" name="password" type="password" class="login-input" required autocomplete="current-password" placeholder="Votre mot de passe">
                        <button type="button" class="login-toggle" id="togglePassword" aria-label="Afficher le mot de passe"><i class="fa fa-eye"></i></button>
                    </div>
                    @error('password')<div class="login-error">{{ $message }}</div>@enderror
                </div>

                <div class="login-options">
                    <label class="login-check"><input type="checkbox" name="remember" id="remember_me"> <span>Se souvenir de moi</span></label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="login-forgot">Mot de passe oublié ?</a>
                    @endif
                </div>

                <button type="submit" class="login-submit"><i class="fa fa-sign-in"></i>&nbsp; Se connecter</button>
            </form>

            <div class="login-divider">ACCÈS À LA PLATEFORME</div>
            <div class="login-back"><a href="{{ url('/') }}"><i class="fa fa-arrow-left"></i> Retour au site</a></div>
            <div class="login-secure"><i class="fa fa-shield"></i> Connexion protégée et confidentielle</div>
        </div>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        if (toggle && password) {
            toggle.addEventListener('click', function () {
                const hidden = password.type === 'password';
                password.type = hidden ? 'text' : 'password';
                this.innerHTML = hidden ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>';
                this.setAttribute('aria-label', hidden ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
            });
        }
    });
</script>
</body>
</html>
