@extends('admin_layout.app')
@section('admin')

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Liste des Rôles</h5>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">+ Nouveau Rôle</a>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach($role->permissions as $perm)
                                                    <span class="badge badge-info">{{ $perm->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce rôle ?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
