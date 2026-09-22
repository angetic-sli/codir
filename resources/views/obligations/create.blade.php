@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h5>Nouvelle Obligation</h5>
            <a href="{{ route('obligations.index') }}" class="btn btn-sm btn-secondary">Retour</a>
          </div>
          <div class="card-block">
            <form action="{{ route('obligations.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control" required>
                  @foreach($types as $type)<option value="{{ $type }}" @selected(old('type') === $type)>{{ $type }}</option>@endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Date début</label>
                <input type="date" name="date_debut" class="form-control">
              </div>

              <div class="form-group">
                <label>Date fin</label>
                <input type="date" name="date_fin" class="form-control">
              </div>

              <div class="form-group">
                <label>Employés concernés</label>
                <select name="users[]" class="form-control" multiple>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenoms }}</option>
                  @endforeach
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
