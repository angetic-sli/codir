@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Modifier la Réunion: {{ $reunion->titre }}</h5>
                        <div class="card-header-right">
                            <a href="{{ route('reunions.show', $reunion->id) }}" class="btn btn-sm btn-info">Voir</a>
                            <a href="{{ route('reunions.index') }}" class="btn btn-sm btn-primary">Retour à la liste</a>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('reunions.update', $reunion->id) }}" method="POST" id="reunionForm">
                            @csrf
                            @method('PUT')
                            
                            <!-- Informations de la réunion -->
                            <div class="section mb-4">
                                <h6 class="section-title">Informations de la Réunion</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Titre *</label>
                                            <input type="text" class="form-control" name="titre" value="{{ old('titre', $reunion->titre) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Date *</label>
                                            <input type="date" class="form-control" name="date" value="{{ old('date', $reunion->date?->format('Y-m-d')) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Lieu *</label>
                                            <input type="text" class="form-control" name="lieu" value="{{ old('lieu', $reunion->lieu) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Heure Début *</label>
                                            <input type="time" class="form-control" name="heure_debut" value="{{ old('heure_debut', $reunion->heure_debut) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Heure Fin *</label>
                                            <input type="time" class="form-control" name="heure_fin" value="{{ old('heure_fin', $reunion->heure_fin) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ordre du Jour *</label>
                                    <textarea class="form-control" name="ordre_du_jour" rows="4" required>{{ old('ordre_du_jour', $reunion->ordre_du_jour) }}</textarea>
                                </div>
                            </div>

                            <!-- Tâches de la réunion -->
                            <div class="section mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="section-title">Tâches de la Réunion</h6>
                                    @can('taches.create')<button type="button" class="btn btn-sm btn-success" onclick="ajouterTache()">
                                        <i class="fa fa-plus"></i> Ajouter une Tâche
                                    </button>@endcan
                                </div>

                                <div class="task-order-help mb-3">
    <i class="fa fa-sort"></i>
    <span>Utilisez <strong>↑</strong> et <strong>↓</strong> pour déplacer une tâche. <strong>L’ordre est enregistré immédiatement dans la base de données.</strong></span>
</div>
<div id="taches-container">
                                    @foreach($reunion->taches as $index => $tache)
                                    <div class="tache-card card mb-3" data-index="{{ $index }}" draggable="true">
                                        <input type="hidden" class="task-order" name="taches[{{ $index }}][ordre]" value="{{ old('taches.'.$index.'.ordre', $tache->ordre ?? ($index + 1)) }}">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="task-position">{{ $index + 1 }}</span>
                                                <h6 class="mb-0 task-title">Tâche #{{ $index + 1 }}</h6>
                                            </div>
                                            <div class="task-actions d-flex align-items-center gap-1">
                                                @can('taches.reorder')<button type="button" class="btn btn-sm btn-outline-secondary" onclick="monterTache(this)" title="Monter la tâche" aria-label="Monter la tâche">
                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="descendreTache(this)" title="Descendre la tâche" aria-label="Descendre la tâche">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>@endcan
                                                @can('taches.delete')<button type="button" class="btn btn-sm btn-danger" onclick="supprimerTache(this)" title="Supprimer la tâche">
                                                    <i class="fa fa-trash"></i>
                                                </button>@endcan
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="taches[{{ $index }}][id]" value="{{ $tache->id }}">
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Titre de la tâche *</label>
                                                        <input type="text" class="form-control" name="taches[{{ $index }}][titre]" value="{{ old('taches.'.$index.'.titre', $tache->titre) }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Activité *</label>
                                                        <select class="form-control" name="taches[{{ $index }}][activite_id]" required>
                                                            <option value="">Sélectionner une activité</option>
                                                            @foreach($activites as $activite)
                                                                <option value="{{ $activite->id }}" {{ old('taches.'.$index.'.activite_id', $tache->activite_id) == $activite->id ? 'selected' : '' }}>
                                                                    {{ $activite->titre }} {{-- CORRECTION: utiliser 'titre' --}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Statut *</label>
                                                        <select class="form-control" name="taches[{{ $index }}][statut]" required>
                                                            <option value="A faire" {{ old('taches.'.$index.'.statut', $tache->statut) == 'A faire' ? 'selected' : '' }}>A faire</option>
                                                            <option value="En cours" {{ old('taches.'.$index.'.statut', $tache->statut) == 'En cours' ? 'selected' : '' }}>En cours</option>
                                                            <option value="Terminé" {{ old('taches.'.$index.'.statut', $tache->statut) == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                                                            <option value="En retard" {{ old('taches.'.$index.'.statut', $tache->statut) == 'En retard' ? 'selected' : '' }}>En retard</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Date Début</label>
                                                        <input type="date" class="form-control" name="taches[{{ $index }}][date_debut]" value="{{ old('taches.'.$index.'.date_debut', $tache->date_debut?->format('Y-m-d')) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Date Fin</label>
                                                        <input type="date" class="form-control" name="taches[{{ $index }}][date_fin]" value="{{ old('taches.'.$index.'.date_fin', $tache->date_fin?->format('Y-m-d')) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Livrable</label>
                                                        <input type="text" class="form-control" name="taches[{{ $index }}][livrable]" value="{{ old('taches.'.$index.'.livrable', $tache->livrable) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">Recommandations</label>
                                                <textarea class="form-control" name="taches[{{ $index }}][recommandations]" rows="2">{{ old('taches.'.$index.'.recommandations', $tache->recommandations) }}</textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">Personnes Assignées</label>
                                                <select class="form-control select2-multiple" name="taches[{{ $index }}][users][]" multiple style="width: 100%;">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ in_array($user->id, old('taches.'.$index.'.users', $tache->users->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                            {{ $user->nom }} {{ $user->prenoms }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group text-right">
                                @can('reunions.update')<button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Mettre à jour la Réunion
                                </button>@endcan
                                @can('taches.create')<button type="button" class="btn btn-success" onclick="ajouterTache()">
                                    <i class="fa fa-plus"></i> Ajouter une Tâche
                                </button>@endcan
                                <a href="{{ route('reunions.show', $reunion->id) }}" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template pour une nouvelle tâche -->
<template id="tache-template">
    <div class="tache-card card mb-3" data-index="{index}" draggable="true">
        <input type="hidden" class="task-order" name="taches[{index}][ordre]" value="{index_plus_one}">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <span class="task-position">{index_plus_one}</span>
                <h6 class="mb-0 task-title">Nouvelle tâche</h6>
            </div>
            <div class="task-actions d-flex align-items-center gap-1">
                @can('taches.reorder')<button type="button" class="btn btn-sm btn-outline-secondary" onclick="monterTache(this)" title="Monter la tâche" aria-label="Monter la tâche">
                    <i class="fa fa-arrow-up"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="descendreTache(this)" title="Descendre la tâche" aria-label="Descendre la tâche">
                    <i class="fa fa-arrow-down"></i>
                </button>@endcan
                @can('taches.delete')<button type="button" class="btn btn-sm btn-danger" onclick="supprimerTache(this)" title="Supprimer la tâche">
                    <i class="fa fa-trash"></i>
                </button>@endcan
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Titre de la tâche *</label>
                        <input type="text" class="form-control" name="taches[{index}][titre]" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Activité *</label>
                        <select class="form-control" name="taches[{index}][activite_id]" required>
                            <option value="">Sélectionner une activité</option>
                            @foreach($activites as $activite)
                                <option value="{{ $activite->id }}">{{ $activite->titre }}</option> {{-- CORRECTION: utiliser 'titre' --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Statut *</label>
                        <select class="form-control" name="taches[{index}][statut]" required>
                            <option value="A faire">A faire</option>
                            <option value="En cours">En cours</option>
                            <option value="Terminé">Terminé</option>
                            <option value="En retard">En retard</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Date Début</label>
                        <input type="date" class="form-control" name="taches[{index}][date_debut]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Fin</label>
                        <input type="date" class="form-control" name="taches[{index}][date_fin]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Livrable</label>
                        <input type="text" class="form-control" name="taches[{index}][livrable]">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Recommandations</label>
                <textarea class="form-control" name="taches[{index}][recommandations]" rows="2"></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Personnes Assignées</label>
                <select class="form-control select2-multiple" name="taches[{index}][users][]" multiple style="width: 100%;">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenoms }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</template>
@endsection

@push('styles')
<style>
.section {
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #fafafa;
}
.section-title {
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #007bff;
    font-weight: bold;
}
.tache-card {
    border-left: 4px solid #28a745;
    background-color: white;
}
.tache-card .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
}

.task-order-help {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 1px solid #dbeafe;
    border-radius: 8px;
    color: #1e40af;
    background: #eff6ff;
    font-size: 13px;
}
.task-order-help i {
    font-size: 16px;
}
#taches-container {
    min-height: 20px;
}
.tache-card {
    cursor: default;
    transition: box-shadow .15s ease, opacity .15s ease;
}
.task-actions {
    flex-wrap: nowrap;
}
.task-actions .btn {
    min-width: 34px;
}
.task-position {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    height: 28px;
    padding: 0 8px;
    border-radius: 999px;
    background: #eaf2ff;
    color: #155eef;
    font-size: 12px;
    font-weight: 700;
}
.tache-card.is-moving {
    opacity: .65;
}
</style>
@endpush

@push('scripts')
<script>
let tacheIndex = {{ $reunion->taches->count() }};

function refreshTaskOrder() {
    const cards = Array.from(document.querySelectorAll('#taches-container .tache-card'));

    cards.forEach((card, position) => {
        const order = position + 1;
        const orderInput = card.querySelector('.task-order');
        const title = card.querySelector('.task-title');
        const badge = card.querySelector('.task-position');

        if (orderInput) orderInput.value = order;
        if (badge) badge.textContent = order;
        if (title) title.textContent = 'Tâche #' + order;
        card.dataset.order = order;

        const up = card.querySelector('[onclick^="monterTache"]');
        const down = card.querySelector('[onclick^="descendreTache"]');
        if (up) up.disabled = position === 0;
        if (down) down.disabled = position === cards.length - 1;
    });

    normalizeTaskNames();
}

// Après un déplacement/suppression, on renumérote aussi les champs HTML.
// Cela évite les clés discontinues et les pertes de données dans taches[index].
function normalizeTaskNames() {
    const cards = Array.from(document.querySelectorAll('#taches-container .tache-card'));
    cards.forEach((card, index) => {
        card.querySelectorAll('[name]').forEach(input => {
            input.name = input.name.replace(/^taches\[[^\]]+\]/, 'taches[' + index + ']');
        });
        card.dataset.index = index;
    });
}

function monterTache(button) {
    const card = button.closest('.tache-card');
    const previous = card ? card.previousElementSibling : null;
    if (!card || !previous || !previous.classList.contains('tache-card')) return;

    card.parentNode.insertBefore(card, previous);
    card.classList.add('is-moving');
    refreshTaskOrder();
    enregistrerOrdreTaches();
    setTimeout(() => card.classList.remove('is-moving'), 180);
}

function descendreTache(button) {
    const card = button.closest('.tache-card');
    const next = card ? card.nextElementSibling : null;
    if (!card || !next || !next.classList.contains('tache-card')) return;

    card.parentNode.insertBefore(next, card);
    card.classList.add('is-moving');
    refreshTaskOrder();
    enregistrerOrdreTaches();
    setTimeout(() => card.classList.remove('is-moving'), 180);
}

async function enregistrerOrdreTaches() {
    const container = document.getElementById('taches-container');
    if (!container) return;

    const ids = Array.from(container.querySelectorAll('.tache-card'))
        .map(card => card.querySelector('input[name$="[id]"]')?.value)
        .filter(Boolean)
        .map(Number);

    // Les nouvelles tâches sans ID seront enregistrées avec la réunion.
    // On ne tente donc l'enregistrement immédiat que si toutes les cartes
    // existantes possèdent déjà un ID.
    const cards = Array.from(container.querySelectorAll('.tache-card'));
    const existingCards = cards.filter(card => card.querySelector('input[name$="[id]"]')?.value);
    if (existingCards.length !== cards.length || ids.length === 0) {
        afficherStatutOrdre('Ordre en attente de l’enregistrement de la nouvelle tâche.', 'warning');
        return;
    }

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        || document.querySelector('input[name="_token"]')?.value;

    afficherStatutOrdre('Enregistrement de l’ordre…', 'info');

    try {
        const response = await fetch(@json(route('reunions.taches.reorder', $reunion->id)), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ tache_ids: ids })
        });

        const result = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(result.message || 'Impossible d’enregistrer l’ordre.');
        }

        afficherStatutOrdre('✓ Ordre enregistré dans la base de données.', 'success');
    } catch (error) {
        console.error('Erreur enregistrement ordre:', error);
        afficherStatutOrdre('⚠ ' + error.message, 'danger');
    }
}

function afficherStatutOrdre(message, type) {
    let status = document.getElementById('task-order-status');
    if (!status) {
        status = document.createElement('span');
        status.id = 'task-order-status';
        status.className = 'badge ml-2';
        document.querySelector('.task-order-help')?.appendChild(status);
    }

    status.className = 'badge ml-2 badge-' + type;
    status.textContent = message;
}

function ajouterTache() {
    const template = document.getElementById('tache-template');
    const container = document.getElementById('taches-container');
    if (!template || !container) return;

    const nouvelleTache = template.innerHTML
        .replace(/{index}/g, tacheIndex)
        .replace(/{index_plus_one}/g, tacheIndex + 1);

    const div = document.createElement('div');
    div.innerHTML = nouvelleTache.trim();
    const card = div.firstElementChild;
    container.appendChild(card);

    const select = card.querySelector('.select2-multiple');
    if (select && window.jQuery && jQuery.fn.select2) {
        jQuery(select).select2({ width: '100%' });
    }

    tacheIndex++;
    refreshTaskOrder();
}

function supprimerTache(button) {
    const card = button.closest('.tache-card');
    if (!card) return;

    const idInput = card.querySelector('input[name$="[id]"]');
    const title = card.querySelector('.task-title')?.textContent || 'cette tâche';
    if (!confirm('Supprimer ' + title + ' ?')) return;

    // La suppression est gérée par le contrôleur à l'enregistrement :
    // le formulaire envoie uniquement les tâches encore présentes.
    card.remove();
    refreshTaskOrder();
}

// Initialisation des sélecteurs et de l'ordre au chargement.
document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery && jQuery.fn.select2) {
        jQuery('.select2-multiple').select2({ width: '100%' });
    }
    refreshTaskOrder();
});

// Sécurité : si le navigateur a restauré la page après une erreur de validation,
// l'ordre et les noms sont recalculés avant l'envoi.
document.getElementById('reunionForm')?.addEventListener('submit', function () {
    refreshTaskOrder();
});
</script>
@endpush