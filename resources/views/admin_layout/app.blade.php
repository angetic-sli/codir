<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Comigest')</title>
    <meta name="description" content="Comigest — pilotage des réunions, activités, tâches et obligations.">
    <link rel="icon" href="{{ asset(config('ipcs.logo')) }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/codir-modern.css') }}">
    @stack('styles')
</head>
<body>
<div class="codir-shell">
    @include('admin_layout.navbar')
    <div class="codir-sidebar-backdrop" id="codirBackdrop"></div>
    @include('admin_layout.sidebar')
    <main class="codir-main">
        @if(session('success'))
            <div class="alert alert-success mb-3"><i class="fa fa-check-circle mr-2"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-3"><i class="fa fa-exclamation-circle mr-2"></i>{{ session('error') }}</div>
        @endif
        @yield('admin')
        <footer class="ipcs-app-footer"><span>© {{ date('Y') }} {{ config('ipcs.name') }}</span><span>{{ config('ipcs.platform') }} · <a href="{{ config('ipcs.website') }}" target="_blank" rel="noopener">ipcs-ci.com</a></span></footer>
    </main>
</div>
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
(function(){
 const btn=document.getElementById('codirMenuToggle'), side=document.getElementById('codirSidebar'), back=document.getElementById('codirBackdrop');
 function toggle(){side.classList.toggle('open');back.style.display=side.classList.contains('open')?'block':'none';}
 if(btn) btn.addEventListener('click',toggle); if(back) back.addEventListener('click',toggle);
 document.querySelectorAll('[data-confirm]').forEach(el=>el.addEventListener('click',e=>{if(!confirm(el.dataset.confirm))e.preventDefault()}));
})();
</script>
@stack('scripts')
</body>
</html>
