<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>IPCS — {{ config('ipcs.platform') }}</title>
<meta name="description" content="{{ config('ipcs.name') }} — {{ config('ipcs.platform') }}, pilotage des réunions, activités, tâches et gouvernance.">
<link rel="icon" href="{{ asset(config('ipcs.logo')) }}" type="image/svg+xml">
<link rel="stylesheet" href="{{ asset('css/codir-modern.css') }}">
<link rel="stylesheet" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}">
</head>
<body class="landing ipcs-landing">
<nav class="landing-nav"><div class="landing-container landing-nav-inner">
<a href="{{ route('home') }}" class="ipcs-logo-lockup"><img src="{{ asset(config('ipcs.logo')) }}" alt="IPCS"><strong>Comigest</strong></a>
<div class="landing-links"><a href="#entreprise">IPCS</a><a href="#services">Services</a><a href="#pilotage">Pilotage</a><a href="#contact">Contact</a></div>
<div><a class="landing-nav-cta" href="{{ route('login') }}">Accéder au CODIR</a></div>
</div></nav>

<section class="ipcs-hero"><div class="landing-container landing-grid">
<div>
<span class="landing-pill"><i class="fa fa-circle"></i> IPCS · Mobilité connectée & gouvernance</span>
<h1>Une entreprise, une vision : <span>piloter avec précision.</span></h1>
<p>{{ config('ipcs.name') }} développe et opère des services dédiés à la mobilité, à la pose de compteurs taxi, au GPS et à la maintenance. <strong>{{ config('ipcs.platform') }}</strong> prolonge cette organisation par un espace interne pour transformer les décisions du CODIR en actions suivies.</p>
<div class="landing-cta"><a class="landing-btn primary" href="{{ route('login') }}">Ouvrir l'espace CODIR <i class="fa fa-arrow-right"></i></a><a class="landing-btn secondary" href="{{ config('ipcs.website') }}" target="_blank" rel="noopener">Voir ipcs-ci.com <i class="fa fa-external-link"></i></a></div>
</div>
<div class="ipcs-hero-card">
    <div style="position:relative;z-index:2;display:flex;justify-content:space-between;align-items:flex-start"><span style="font-size:11px;font-weight:900;letter-spacing:.1em;text-transform:uppercase">IPCS / CODIR</span><i class="fa fa-dashboard" style="font-size:24px;color:#ffe000"></i></div>
    <div class="ipcs-hero-panel"><h3>Pilotage centralisé</h3><p>Réunions, décisions, tâches, responsables, échéances, livrables, clients, obligations et rapports réunis dans un même espace.</p><div class="ipcs-hero-metric"><span><i class="fa fa-calendar"></i> Réunions</span><span><i class="fa fa-map-marker"></i> GPS & mobilité</span><span><i class="fa fa-check-square-o"></i> Actions</span></div></div>
</div>
</div></section>

<section id="entreprise" class="landing-section"><div class="landing-container"><div class="section-head"><span class="eyebrow">IPCS</span><h2>Une identité métier intégrée directement à votre outil de direction.</h2><p>{{ config('ipcs.name') }} est présentée sur son site comme une société de services intervenant notamment dans la mobilité et les solutions GPS. Le portail CODIR reprend cette identité pour que l'outil interne reste cohérent avec l'entreprise.</p></div>
<div class="stats"><div class="stat"><strong>2015</strong><span>création d'IPCS selon le site</span></div><div class="stat"><strong>3 M</strong><span>capital annoncé · FCFA</span></div><div class="stat"><strong>GPS</strong><span>suivi et géolocalisation</span></div><div class="stat"><strong>24/7</strong><span>pilotage interne disponible</span></div></div></div></section>

<section id="services" class="landing-section alt"><div class="landing-container"><div class="section-head"><span class="eyebrow">Notre expertise</span><h2>Les activités IPCS, prolongées par le pilotage CODIR.</h2><p>Le site IPCS présente notamment les services suivants : pose de compteurs, installation et suivi GPS, maintenance et réparation.</p></div>
<div class="feature-grid">
<div class="feature-card ipcs-service-card"><div class="feature-icon"><i class="fa fa-tachometer"></i></div><h3>Pose de compteurs taxi</h3><p>Installation de compteurs homologués et accompagnement des professionnels du transport.</p></div>
<div class="feature-card ipcs-service-card"><div class="feature-icon"><i class="fa fa-map-marker"></i></div><h3>Installation & suivi GPS</h3><p>Géolocalisation, suivi de flotte et gestion des itinéraires pour les véhicules.</p></div>
<div class="feature-card ipcs-service-card"><div class="feature-icon"><i class="fa fa-wrench"></i></div><h3>Maintenance & réparation</h3><p>Suivi technique et interventions sur les équipements de mobilité.</p></div>
<div class="feature-card ipcs-service-card"><div class="feature-icon"><i class="fa fa-line-chart"></i></div><h3>Pilotage CODIR</h3><p>Réunions, actions, obligations, livrables et rapports dans un espace sécurisé.</p></div>
<div class="feature-card ipcs-service-card"><div class="feature-icon"><i class="fa fa-users"></i></div><h3>Équipe & responsabilités</h3><p>Attribution des tâches et visibilité sur les responsables et les échéances.</p></div>
<div class="feature-card ipcs-service-card"><div class="feature-icon"><i class="fa fa-file-text-o"></i></div><h3>Exports & rapports</h3><p>Production des supports de suivi pour les réunions et le pilotage de la direction.</p></div>
</div></div></section>

<section id="pilotage" class="landing-section"><div class="landing-container"><div class="ipcs-company-band"><div style="position:relative;z-index:2"><span class="eyebrow" style="color:#ffe000">IPCS · {{ config('ipcs.platform') }}</span><h2>De la décision à l'exécution.</h2><p>Chaque réunion peut devenir une séquence d'actions : responsable, échéance, statut, livrable et suivi. L'interface interne conserve l'identité IPCS tout en apportant les outils de gouvernance.</p><div class="ipcs-company-meta"><span><i class="fa fa-shield"></i> Permissions & rôles</span><span><i class="fa fa-calendar"></i> Réunions CODIR</span><span><i class="fa fa-tasks"></i> Tâches & actions</span><span><i class="fa fa-bar-chart"></i> Rapports</span></div></div></div></div></section>

<section id="contact" class="landing-section"><div class="landing-container"><div class="landing-final"><h2>Bienvenue dans le nouvel espace IPCS.</h2><p>{{ config('ipcs.address') }}<br>{{ config('ipcs.hours') }}</p><div class="landing-cta"><a class="landing-btn secondary" href="{{ route('login') }}">Accéder à {{ config('ipcs.platform') }} <i class="fa fa-arrow-right"></i></a><a class="landing-btn secondary" href="{{ config('ipcs.website') }}" target="_blank" rel="noopener">Site officiel IPCS <i class="fa fa-external-link"></i></a></div></div></div></section>

<footer class="landing-footer"><div class="landing-container footer-inner"><div>© {{ date('Y') }} {{ config('ipcs.name') }} · {{ config('ipcs.platform') }}</div><div class="footer-links"><a href="#entreprise">IPCS</a><a href="#services">Services</a><a href="#pilotage">Pilotage</a><a href="{{ config('ipcs.website') }}" target="_blank" rel="noopener">ipcs-ci.com</a></div></div></footer>
</body></html>
