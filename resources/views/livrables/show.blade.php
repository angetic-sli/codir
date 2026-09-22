@extends('admin_layout.app')
@section('admin')
<div class="card"><div class="card-header d-flex justify-content-between"><h5>Détail du livrable</h5><a href="{{ route('taches.show', $livrable->tache_id) }}" class="btn btn-sm btn-secondary">Retour à la tâche</a></div><div class="card-block">
<p><strong>Type :</strong> {{ $livrable->type ?: '—' }}</p><p><strong>Description :</strong><br>{{ $livrable->description ?: '—' }}</p>
@if($livrable->fichier_path)<p><a class="btn btn-primary" href="{{ asset('storage/'.$livrable->fichier_path) }}" target="_blank">Ouvrir le fichier</a></p>@endif
</div></div>
@endsection
