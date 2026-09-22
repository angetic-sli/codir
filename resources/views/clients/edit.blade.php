@extends('admin_layout.app')
@section('admin')
<div class="card"><div class="card-header"><h5>Modifier le client</h5></div><div class="card-block"><form method="POST" action="{{ route('clients.update', $client) }}">@csrf @method('PUT')
<div class="row"><div class="col-md-6 form-group"><label>Nom</label><input name="nom" class="form-control" value="{{ old('nom',$client->nom) }}" required></div><div class="col-md-6 form-group"><label>Contact</label><input name="contact" class="form-control" value="{{ old('contact',$client->contact) }}"></div></div>
<div class="row"><div class="col-md-6 form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$client->email) }}"></div><div class="col-md-6 form-group"><label>Secteur</label><input name="secteur_activite" class="form-control" value="{{ old('secteur_activite',$client->secteur_activite) }}"></div></div>
<div class="row"><div class="col-md-4 form-group"><label>Adresse</label><input name="adresse" class="form-control" value="{{ old('adresse',$client->adresse) }}"></div><div class="col-md-4 form-group"><label>Ville</label><input name="ville" class="form-control" value="{{ old('ville',$client->ville) }}"></div><div class="col-md-4 form-group"><label>Pays</label><input name="pays" class="form-control" value="{{ old('pays',$client->pays) }}"></div></div>
<div class="form-group"><label>Description</label><textarea name="description" class="form-control">{{ old('description',$client->description) }}</textarea></div>
<button class="btn btn-primary">Enregistrer</button> <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
</form></div></div>
@endsection
