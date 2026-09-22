@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header"><h5>Modifier Utilisateur</h5></div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control" value="{{ $user->nom }}" required>
                            </div>
                            <div class="form-group">
                                <label>Prénoms</label>
                                <input type="text" name="prenoms" class="form-control" value="{{ $user->prenoms }}">
                            </div>
                            <div class="form-group">
                                <label>Fonction</label>
                                <input type="text" name="fonction" class="form-control" value="{{ $user->fonction }}">
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="contact" class="form-control" value="{{ $user->contact }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group form-primary">
                                <label for="role">Rôle</label>
                                <select name="role" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" 
                                            {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
