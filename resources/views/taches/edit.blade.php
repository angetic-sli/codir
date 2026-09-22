@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Modifier la Tâche</h5>
                            </div>
                            <div class="card-block">
                                <form action="{{ route('taches.update', $tache->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- Sélection de la réunion --}}
                                    <div class="form-group form-default">
                                        <label>Réunion</label>
                                        <select name="reunion_id" class="form-control" required>
                                            <option value="">-- Sélectionner une réunion --</option>
                                            @foreach($reunions as $reunion)
                                                <option value="{{ $reunion->id }}"
                                                    {{ $tache->reunion_id == $reunion->id ? 'selected' : '' }}>
                                                    {{ $reunion->titre }} ({{ $reunion->date }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Sélection de l’activité --}}
                                    <div class="form-group form-default">
                                        <label>Activité</label>
                                        <select name="activite_id" class="form-control" required>
                                            <option value="">-- Sélectionner une activité --</option>
                                            @foreach($activites as $activite)
                                                <option value="{{ $activite->id }}"
                                                    {{ $tache->activite_id == $activite->id ? 'selected' : '' }}>
                                                    {{ $activite->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Titre --}}
                                    <div class="form-group form-primary">
                                        <input type="text" name="titre" class="form-control" value="{{ $tache->titre }}" required>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Titre de la tâche</label>
                                    </div>

                                    {{-- Recommandations --}}
                                    <div class="form-group form-success">
                                        <textarea name="recommandations" class="form-control" rows="3">{{ $tache->recommandations }}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Recommandations</label>
                                    </div>

                                    {{-- Dates --}}
                                    <div class="form-group form-info">
                                        <input type="date" name="date_debut" class="form-control" value="{{ $tache->date_debut }}">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Date début</label>
                                    </div>

                                    <div class="form-group form-warning">
                                        <input type="date" name="date_fin" class="form-control" value="{{ $tache->date_fin }}">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Date fin</label>
                                    </div>

                                    {{-- Livrable --}}
                                    <div class="form-group form-danger">
                                        <input type="text" name="livrable" class="form-control" value="{{ $tache->livrable }}">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Livrable attendu</label>
                                    </div>

                                    {{-- Statut --}}
                                    <div class="form-group form-default">
                                        <select name="statut" class="form-control" required>
                                            <option value="A faire" {{ $tache->statut == 'A faire' ? 'selected' : '' }}>A faire</option>
                                            <option value="En cours" {{ $tache->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                                            <option value="Terminé" {{ $tache->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                                            <option value="En retard" {{ $tache->statut == 'En retard' ? 'selected' : '' }}>En retard</option>
                                        </select>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Statut</label>
                                    </div>

                                    {{-- users --}}
                                    <div class="form-group form-primary">
                                        <label>Acteurs responsables</label>
                                        <select name="users[]" class="form-control" multiple>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ in_array($user->id, $tache->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $user->nom }} {{ $user->prenoms }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    <a href="{{ route('taches.index') }}" class="btn btn-secondary">Annuler</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
