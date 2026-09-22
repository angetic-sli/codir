@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Liste des Tâches</h5>
                        <span>Tâches liées aux activités et réunions</span>
                        <div class="card-header-right">
                            @can('taches.create')
            <a href="{{ route('taches.create') }}" class="btn btn-sm btn-primary">
                                + Nouvelle Tâche
                            </a>
            @endcan
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Réunion</th>
                                        <th>Activité</th>
                                        <th>Statut</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Acteurs</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($taches as $tache)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $tache->titre }}</td>

                                            {{-- Réunion --}}
                                            <td>
                                                @if($tache->reunion)
                                                    <span class="badge badge-secondary">
                                                        {{ $tache->reunion->titre }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            {{-- Activité --}}
                                            <td>
                                                @if($tache->activite)
                                                    <span class="badge badge-info">
                                                        {{ $tache->activite->titre }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            {{-- Statut --}}
                                            <td>
                                                <span class="badge 
                                                    @if($tache->statut == 'En cours') badge-warning
                                                    @elseif($tache->statut == 'Terminé') badge-success
                                                    @elseif($tache->statut == 'En retard') badge-danger
                                                    @else badge-secondary @endif">
                                                    {{ $tache->statut }}
                                                </span>
                                            </td>

                                            <td>{{ $tache->date_debut ?? '-' }}</td>
                                            <td>{{ $tache->date_fin ?? '-' }}</td>

                                            {{-- users --}}
                                            <td>
                                                @if($tache->users->count())
                                                    @foreach($tache->users as $user)
                                                        <span class="badge badge-primary">
                                                            {{ $user->nom }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Aucun</span>
                                                @endif
                                            </td>

                                            {{-- Actions --}}
                                            <td>
                                                @can('taches.view')<a href="{{ route('taches.show', $tache->id) }}" class="btn btn-sm btn-info">Voir</a>@endcan
                                                @can('taches.update')<a href="{{ route('taches.edit', $tache->id) }}" class="btn btn-sm btn-warning">Modifier</a>@endcan
                                                @can('taches.delete')<form action="{{ route('taches.destroy', $tache->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette tâche ?')">
                                                        Supprimer
                                                    </button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Aucune tâche trouvée.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $taches->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
