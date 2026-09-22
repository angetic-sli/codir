@extends('admin_layout.app')

@section('admin')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>Modifier le Livrable</h5>
            </div>
            <div class="card-block">
                <form class="form-material" method="POST" action="{{ route('livrables.update', $livrable->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-primary">
                        <input type="text" name="type" class="form-control" value="{{ old('type', $livrable->type) }}">
                        <span class="form-bar"></span>
                        <label class="float-label">Type (ex: Rapport, Décision, Document...)</label>
                    </div>

                    <div class="form-group form-success">
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $livrable->description) }}</textarea>
                        <span class="form-bar"></span>
                        <label class="float-label">Description</label>
                    </div>

                    <div class="form-group form-info">
                        <input type="file" name="fichier" class="form-control">
                        <span class="form-bar"></span>
                        <label class="float-label">Fichier (laisser vide si inchangé)</label>
                        @if($livrable->fichier_path)
                            <p class="mt-2">
                                Fichier actuel : 
                                <a href="{{ asset('storage/'.$livrable->fichier_path) }}" target="_blank">Télécharger</a>
                            </p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('taches.show', $livrable->tache_id) }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
