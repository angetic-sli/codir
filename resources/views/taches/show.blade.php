@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">

                <div class="card">
                    <div class="card-header">
                        <h5>Détails de la Tâche</h5>
                        <div class="card-header-right">
                            <a href="{{ route('taches.index') }}" class="btn btn-sm btn-secondary">← Retour</a>
                            <a href="{{ route('taches.edit', $tache->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette tâche ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-block">
                        <h4 class="mb-3">{{ $tache->titre }}</h4>

                        {{-- Réunion --}}
                        <p>
                            <strong>Réunion :</strong>
                            @if($tache->reunion)
                                <span class="badge badge-secondary">{{ $tache->reunion->titre }} ({{ $tache->reunion->date }})</span>
                            @else
                                <span class="text-muted">Aucune réunion associée</span>
                            @endif
                        </p>

                        {{-- Activité --}}
                        <p>
                            <strong>Activité :</strong>
                            @if($tache->activite)
                                <span class="badge badge-info">{{ $tache->activite->titre }}</span>
                            @else
                                <span class="text-muted">Aucune activité associée</span>
                            @endif
                        </p>

                        {{-- Recommandations --}}
                        <p>
                            <strong>Recommandations :</strong><br>
                            {{ $tache->recommandations ?? 'Aucune recommandation' }}
                        </p>

                        {{-- Dates --}}
                        <p>
                            <strong>Date début :</strong> {{ $tache->date_debut ?? '-' }} <br>
                            <strong>Date fin :</strong> {{ $tache->date_fin ?? '-' }}
                        </p>

                        {{-- Livrable --}}
                        <p>
                            <strong>Livrable attendu :</strong> {{ $tache->livrable ?? 'Non défini' }}
                        </p>

                        {{-- Statut --}}
                        <p>
                            <strong>Statut :</strong>
                            <span class="badge 
                                @if($tache->statut == 'En cours') badge-warning
                                @elseif($tache->statut == 'Terminé') badge-success
                                @elseif($tache->statut == 'En retard') badge-danger
                                @else badge-secondary @endif">
                                {{ $tache->statut }}
                            </span>
                        </p>

                        {{-- users --}}
                        <p>
                            <strong>Acteurs responsables :</strong><br>
                            @if($tache->users->count())
                                @foreach($tache->users as $user)
                                    <span class="badge badge-primary">{{ $user->nom }} {{ $user->prenoms }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Aucun acteur assigné</span>
                            @endif
                        </p>

                        <hr>
                        <p class="text-muted">
                            <small>Créée le : {{ $tache->created_at->format('d/m/Y H:i') }} |
                            Dernière mise à jour : {{ $tache->updated_at->format('d/m/Y H:i') }}</small>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
