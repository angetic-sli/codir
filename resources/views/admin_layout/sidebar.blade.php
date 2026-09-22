<aside class="codir-sidebar ipcs-sidebar" id="codirSidebar">
    <div class="ipcs-side-brand">
        <img src="{{ asset(config('ipcs.logo')) }}" alt="IPCS">
        <div><strong>{{ config('ipcs.short_name') }}</strong><small>{{ config('ipcs.platform') }}</small></div>
    </div>
    <div class="codir-nav-label">Espace de travail</div>
    <ul class="codir-nav">
        @can('dashboard.view')
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><span class="codir-nav-icon"><i class="fa fa-th-large"></i></span>Tableau de bord</a></li>
        @endcan
        @can('reunions.view')
        <li class="{{ request()->is('reunions*') ? 'active' : '' }}"><a href="{{ route('reunions.index') }}"><span class="codir-nav-icon"><i class="fa fa-calendar"></i></span>Réunions CODIR</a></li>
        @endcan
        @can('activites.view')
        <li class="{{ request()->is('activites*') ? 'active' : '' }}"><a href="{{ route('activites.index') }}"><span class="codir-nav-icon"><i class="fa fa-briefcase"></i></span>Activités</a></li>
        @endcan
        @can('taches.view')
        <li class="{{ request()->is('taches*') ? 'active' : '' }}"><a href="{{ route('taches.index') }}"><span class="codir-nav-icon"><i class="fa fa-check-square-o"></i></span>Tâches & actions</a></li>
        @endcan
        @can('obligations.view')
        <li class="{{ request()->is('obligations*') ? 'active' : '' }}"><a href="{{ route('obligations.index') }}"><span class="codir-nav-icon"><i class="fa fa-clipboard"></i></span>Obligations</a></li>
        @endcan
        @can('livrables.view')
        <li class="{{ request()->is('livrables*') ? 'active' : '' }}"><a href="{{ route('livrables.index') }}"><span class="codir-nav-icon"><i class="fa fa-folder-open-o"></i></span>Livrables</a></li>
        @endcan
    </ul>
    <div class="codir-nav-label">Relations & équipe</div>
    <ul class="codir-nav">
        @can('users.view')<li class="{{ request()->is('users*') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><span class="codir-nav-icon"><i class="fa fa-users"></i></span>Équipe</a></li>@endcan
        @can('clients.view')<li class="{{ request()->is('clients*') ? 'active' : '' }}"><a href="{{ route('clients.index') }}"><span class="codir-nav-icon"><i class="fa fa-building-o"></i></span>Clients</a></li>@endcan
        @can('cr-clienteles.view')<li class="{{ request()->is('cr-clienteles*') ? 'active' : '' }}"><a href="{{ route('cr-clienteles.index') }}"><span class="codir-nav-icon"><i class="fa fa-comments-o"></i></span>CR clientèle</a></li>@endcan
    </ul>
    <div class="codir-nav-label">Pilotage</div>
    <ul class="codir-nav">
        @can('rapports.view')<li class="{{ request()->is('rapports*') ? 'active' : '' }}"><a href="{{ route('rapports.codir.index') }}"><span class="codir-nav-icon"><i class="fa fa-bar-chart"></i></span>Rapports CODIR</a></li>@endcan
        @can('roles.view')<li class="{{ request()->is('admin/roles*') ? 'active' : '' }}"><a href="{{ route('roles.index') }}"><span class="codir-nav-icon"><i class="fa fa-lock"></i></span>Rôles</a></li>@endcan
        @can('permissions.view')<li class="{{ request()->is('admin/permissions*') ? 'active' : '' }}"><a href="{{ route('permissions.index') }}"><span class="codir-nav-icon"><i class="fa fa-shield"></i></span>Permissions</a></li>@endcan
    </ul>
    <div class="ipcs-side-card">
        <div class="ipcs-side-card-title"><i class="fa fa-car"></i> IPCS Transport</div>
        <div>Compteurs taxi · GPS · Maintenance</div>
        <a href="{{ config('ipcs.website') }}" target="_blank" rel="noopener">Visiter ipcs-ci.com <i class="fa fa-external-link"></i></a>
    </div>
</aside>
