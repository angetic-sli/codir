@extends('admin_layout.app')
@section('admin')
<div class="pcoded-inner-content"><div class="main-body"><div class="page-wrapper"><div class="page-body">
<div class="card"><div class="card-header d-flex justify-content-between"><h5>Modifier l'obligation</h5><a href="{{ route('obligations.index') }}" class="btn btn-sm btn-secondary">Retour</a></div>
<div class="card-block">
<form action="{{ route('obligations.update', $obligation) }}" method="POST">@csrf @method('PUT')
<div class="form-group"><label>Titre</label><input name="titre" class="form-control" value="{{ old('titre', $obligation->titre) }}" required></div>
<div class="form-group"><label>Description</label><textarea name="description" class="form-control">{{ old('description', $obligation->description) }}</textarea></div>
<div class="form-group"><label>Type</label><select name="type" class="form-control" required>@foreach($types as $type)<option value="{{ $type }}" @selected(old('type', $obligation->type)===$type)>{{ $type }}</option>@endforeach</select></div>
<div class="row"><div class="col-md-6 form-group"><label>Date début</label><input type="date" name="date_debut" class="form-control" value="{{ old('date_debut', optional($obligation->date_debut)->format('Y-m-d')) }}" required></div><div class="col-md-6 form-group"><label>Date fin</label><input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', optional($obligation->date_fin)->format('Y-m-d')) }}"></div></div>
<div class="form-group"><label>Employés concernés</label><select name="users[]" class="form-control" multiple required>@foreach($users as $user)<option value="{{ $user->id }}" @selected($obligation->users->contains($user->id))>{{ $user->nom }} {{ $user->prenoms }}</option>@endforeach</select></div>
<button class="btn btn-primary">Mettre à jour</button>
</form></div></div></div></div></div></div>
@endsection
