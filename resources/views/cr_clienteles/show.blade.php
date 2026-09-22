@extends('admin_layout.app')
@section('admin')
<div class="card"><div class="card-header d-flex justify-content-between"><h5>Compte rendu clientèle</h5><a href="{{ route('cr-clienteles.index') }}" class="btn btn-sm btn-secondary">Retour</a></div><div class="card-block">
<p><strong>Client :</strong> {{ $crClientele->client?->nom }}</p><p><strong>Agent :</strong> {{ $crClientele->user?->nom_complet }}</p><p><strong>Date :</strong> {{ $crClientele->date_passage?->format('d/m/Y') }}</p><p><strong>Objet :</strong> {{ $crClientele->objet }}</p><p><strong>Statut :</strong> {{ $crClientele->statut }}</p><hr>
<p><strong>Compte rendu</strong><br>{{ $crClientele->compte_rendu ?: '—' }}</p><p><strong>Actions prévues</strong><br>{{ $crClientele->actions_prevues ?: '—' }}</p><p><strong>Actions réalisées</strong><br>{{ $crClientele->actions_realisees ?: '—' }}</p>
</div></div>
@endsection
