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
                        <h5>Modifier l'Activité</h5>
                        <div class="card-header-right">
                            <a href="{{ route('activites.index') }}" class="btn btn-sm btn-primary">Retour à la liste</a>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('activites.update', $activite->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">titre de l'activité *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="titre" value="{{ old('titre', $activite->titre) }}" required>
                                    @error('titre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" rows="4">{{ old('description', $activite->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    <a href="{{ route('activites.index') }}" class="btn btn-secondary">Annuler</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection