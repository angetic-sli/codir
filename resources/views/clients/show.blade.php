@extends('admin_layout.app')
@section('admin')
<div class="card"><div class="card-header d-flex justify-content-between"><h5>Détail client</h5><a href="{{ route('clients.index') }}" class="btn btn-sm btn-secondary">Retour</a></div><div class="card-block">
<h4>{{ $client->nom }}</h4><p><strong>Email :</strong> {{ $client->email ?: '—' }}</p><p><strong>Contact :</strong> {{ $client->contact ?: '—' }}</p><p><strong>Adresse :</strong> {{ $client->adresse ?: '—' }}, {{ $client->ville ?: '' }} {{ $client->pays ?: '' }}</p><p><strong>Secteur :</strong> {{ $client->secteur_activite ?: '—' }}</p><p><strong>Description :</strong><br>{{ $client->description ?: '—' }}</p>
<hr><h5>Comptes rendus clientèle</h5>
<table class="table"><thead><tr><th>Date</th><th>Agent</th><th>Objet</th><th>Statut</th></tr></thead><tbody>@forelse($client->crClienteles as $cr)<tr><td>{{ $cr->date_passage?->format('d/m/Y') }}</td><td>{{ $cr->user?->nom_complet }}</td><td>{{ $cr->objet }}</td><td>{{ $cr->statut }}</td></tr>@empty<tr><td colspan="4">Aucun compte rendu.</td></tr>@endforelse</tbody></table>
</div></div>
@endsection
