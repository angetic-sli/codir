@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Nouveau Livrable</h5>
                            </div>
                            <div class="card-block">
                                <form class="form-material" method="POST" action="{{ route('livrables.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group form-primary">
                                        <label>Tâche</label>
                                        <select name="tache_id" class="form-control" required>
                                            <option value="">-- Sélectionnez une tâche --</option>
                                            @foreach($taches as $item)
                                                <option value="{{ $item->id }}" @selected(old('tache_id', $tache?->id) == $item->id)>{{ $item->titre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group form-primary">
                                        <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Type (ex: Rapport, Décision, Document...)</label>
                                    </div>

                                    <div class="form-group form-success">
                                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Description</label>
                                    </div>

                                    <div class="form-group form-info">
                                        <input type="file" name="fichier" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Fichier (PDF, DOCX, XLSX, PNG, JPG)</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    <a href="{{ $tache ? route('taches.show', $tache->id) : route('livrables.index') }}" class="btn btn-secondary">Annuler</a>
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
