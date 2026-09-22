@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Créer un CR Clientèle</h5>
                        <a href="{{ route('cr-clienteles.index') }}" class="btn btn-sm btn-secondary">Retour</a>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('cr-clienteles.store') }}" method="POST" class="form-material">
                            @csrf

                            {{-- Sélection du client --}}
                            <div class="form-group form-primary">
                                <label for="client_id">Client</label>
                                <select name="client_id" class="form-control" required>
                                    <option value="">-- Sélectionnez un client --</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Sélection de l'agent --}}
                            <div class="form-group form-primary">
                                <label for="user_id">Agent</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">-- Sélectionnez un agent --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenoms }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Date de passage --}}
                            <div class="form-group form-primary">
                                <label for="date_passage">Date de passage</label>
                                <input type="date" name="date_passage" class="form-control" required>
                            </div>

                            {{-- Objet de la visite --}}
                            <div class="form-group form-primary">
                                <label for="objet">Objet de la visite</label>
                                <input type="text" name="objet" class="form-control" required>
                            </div>

                            {{-- Actions prévues --}}
                            <div class="form-group form-primary">
                                <label for="actions_prevues">Actions prévues</label>
                                <textarea name="actions_prevues" class="form-control" rows="3" required></textarea>
                            </div>

                            {{-- Actions réalisées --}}
                            <div class="form-group form-primary">
                                <label for="actions_realisees">Actions réalisées</label>
                                <textarea name="actions_realisees" class="form-control" rows="3"></textarea>
                            </div>

                            {{-- Statut --}}
                            <div class="form-group form-primary">
                                <label for="statut">Statut</label>
                                <select name="statut" class="form-control">
                                    <option value="Planifié">Planifié</option>
                                    <option value="Effectué">Effectué</option>
                                    <option value="Annulé">Annulé</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
