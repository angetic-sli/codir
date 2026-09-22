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
                                <h5>Nouvelle(s) Tâche(s)</h5>
                            </div>
                            <div class="card-block">
                                <form class="form-material" method="POST" action="{{ route('taches.store') }}">
                                    @csrf

                                    <div id="taches-container">
                                        <div class="tache-item border p-3 mb-3 rounded">

                                            {{-- Sélection de la réunion --}}
                                            <div class="form-group form-default">
                                                <label>Réunion</label>
                                                <select name="taches[0][reunion_id]" class="form-control" required>
                                                    <option value="">-- Sélectionner une réunion --</option>
                                                    @foreach($reunions as $reunion)
                                                        <option value="{{ $reunion->id }}">
                                                            {{ $reunion->titre }} ({{ $reunion->date }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Sélection de l’activité --}}
                                            <div class="form-group form-default">
                                                <label>Activité</label>
                                                <select name="taches[0][activite_id]" class="form-control" required>
                                                    <option value="">-- Sélectionner une activité --</option>
                                                    @foreach($activites as $activite)
                                                        <option value="{{ $activite->id }}">
                                                            {{ $activite->titre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Titre --}}
                                            <div class="form-group form-primary">
                                                <input type="text" name="taches[0][titre]" class="form-control" required>
                                                <span class="form-bar"></span>
                                                <label class="float-label">Titre de la tâche</label>
                                            </div>

                                            {{-- Recommandations --}}
                                            <div class="form-group form-success">
                                                <textarea name="taches[0][recommandations]" class="form-control" rows="3"></textarea>
                                                <span class="form-bar"></span>
                                                <label class="float-label">Recommandations</label>
                                            </div>

                                            {{-- Dates --}}
                                            <div class="form-group form-info">
                                                <input type="date" name="taches[0][date_debut]" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Date début</label>
                                            </div>

                                            <div class="form-group form-warning">
                                                <input type="date" name="taches[0][date_fin]" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Date fin</label>
                                            </div>

                                            {{-- Livrable --}}
                                            <div class="form-group form-danger">
                                                <input type="text" name="taches[0][livrable]" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Livrable attendu</label>
                                            </div>

                                            {{-- Statut --}}
                                            <div class="form-group form-default">
                                                <select name="taches[0][statut]" class="form-control" required>
                                                    <option value="A faire">A faire</option>
                                                    <option value="En cours">En cours</option>
                                                    <option value="Terminé">Terminé</option>
                                                    <option value="En retard">En retard</option>
                                                </select>
                                                <span class="form-bar"></span>
                                                <label class="float-label">Statut</label>
                                            </div>

                                            {{-- users --}}
                                            <div class="form-group form-primary">
                                                <label>Acteurs responsables</label>
                                                <select name="taches[0][users][]" class="form-control" multiple>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->nom }} {{ $user->prenoms }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Bouton pour ajouter une autre tâche --}}
                                    <button type="button" id="add-tache" class="btn btn-secondary mb-3">
                                        + Ajouter une autre tâche
                                    </button>
                                    <br>

                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script JS pour dupliquer les champs --}}
<script>
    let index = 1;
    document.getElementById('add-tache').addEventListener('click', function () {
        let container = document.getElementById('taches-container');
        let newItem = container.firstElementChild.cloneNode(true);

        // Met à jour les noms de champs pour ne pas écraser les précédents
        newItem.querySelectorAll('input, textarea, select').forEach(el => {
            let name = el.getAttribute('name');
            if (name) {
                el.setAttribute('name', name.replace(/\d+/, index));
                if (el.type !== 'select-multiple') {
                    el.value = '';
                }
            }
        });

        container.appendChild(newItem);
        index++;
    });
</script>
@endsection
