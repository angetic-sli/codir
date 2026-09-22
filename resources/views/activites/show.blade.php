@extends('admin_layout.app')

@section('admin')
<div class="card">
    <div class="card-header">
        <h5>Détails de l’Activité</h5>
        <div class="card-header-right">
            <a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        </div>
    </div>
    <div class="card-block">
        <p><strong>Titre :</strong> {{ $activite->titre }}</p>
        <p><strong>Description :</strong> {{ $activite->description }}</p>
        <p><strong>Réunion :</strong> {{ $activite->reunion->titre ?? 'N/A' }}</p>
    </div>
</div>

{{-- Liste des tâches liées --}}
<div class="card mt-4">
    <div class="card-header">
        <h5>Tâches liées</h5>
        <div class="card-header-right">
            <a href="{{ route('taches.create', ['activite' => $activite->id]) }}" class="btn btn-sm btn-primary">+ Nouvelle Tâche</a>
        </div>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activite->taches as $tache)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $tache->titre }}</td>
                            <td>{{ $tache->statut }}</td>
                            <td>{{ $tache->date_debut }}</td>
                            <td>{{ $tache->date_fin }}</td>
                            <td>
                                <a href="{{ route('taches.show', $tache->id) }}" class="btn btn-sm btn-info">Voir</a>
                                <a href="{{ route('taches.edit', $tache->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
