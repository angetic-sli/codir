<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="csrf-token" content="{{ csrf_token() }}"><title>{{ config('ipcs.short_name') }} · {{ config('ipcs.platform') }}</title><link rel="icon" href="{{ asset(config('ipcs.logo')) }}" type="image/svg+xml"><link rel="stylesheet" href="{{ asset('css/codir-modern.css') }}"><link rel="stylesheet" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}"></head>
<body><div class="codir-auth"><div class="codir-auth-card"><a href="{{ route('home') }}" class="ipcs-logo-lockup" style="margin-bottom:25px"><img src="{{ asset(config('ipcs.logo')) }}" alt="IPCS"><strong>{{ config('ipcs.platform') }}</strong></a>{{ $slot }}</div></div></body>
</html>
