<header class="codir-topbar ipcs-topbar">
    <button class="codir-menu-toggle" id="codirMenuToggle" aria-label="Ouvrir le menu"><i class="fa fa-bars"></i></button>
    <a href="{{ route('dashboard') }}" class="codir-brand ipcs-brand">
        <span class="ipcs-brand-logo"><img src="{{ asset(config('ipcs.logo')) }}" alt="IPCS"></span>
        <span><strong>{{ config('ipcs.short_name') }} <em>·</em> {{ config('ipcs.platform') }}</strong><small>Pilotage & gouvernance interne</small></span>
    </a>
    <div class="codir-topbar-center">
        <label class="codir-search mb-0">
            <i class="fa fa-search"></i>
            <input type="search" placeholder="Rechercher dans IPCS / CODIR..." aria-label="Rechercher">
            <span class="d-none d-md-inline" style="font-size:10px">⌘ K</span>
        </label>
    </div>
    <div class="codir-user">
        <a class="ipcs-site-link d-none d-lg-flex" href="{{ config('ipcs.website') }}" target="_blank" rel="noopener" title="Visiter le site IPCS"><i class="fa fa-globe"></i><span>Site IPCS</span></a>
        <button class="codir-icon-btn" type="button" onclick="if(document.documentElement.requestFullscreen) document.documentElement.requestFullscreen()" title="Plein écran"><i class="fa fa-expand"></i></button>
        <div class="codir-avatar">{{ strtoupper(substr(Auth::user()->prenoms ?? Auth::user()->nom ?? 'U',0,1)) }}</div>
        <div class="d-none d-sm-block"><div class="codir-user-name">{{ Auth::user()->nom ?? '' }} {{ Auth::user()->prenoms ?? '' }}</div><div class="codir-user-role">{{ Auth::user()->fonction ?? 'Utilisateur' }}</div></div>
        <form action="{{ route('logout') }}" method="POST" class="ml-1">@csrf<button class="codir-icon-btn" title="Déconnexion" type="submit"><i class="fa fa-sign-out"></i></button></form>
    </div>
</header>
