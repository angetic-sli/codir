@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Gestion des Rôles</h5>
                        @can('roles.create')<a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">+ Nouveau Rôle</a>@endcan
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
                                    @forelse($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach($role->permissions as $permission)
                                                    <span class="badge badge-info">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @can('roles.update')<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Modifier</a>@endcan
                                                @can('roles.delete')<form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce rôle ?')">Supprimer</button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center">Aucun rôle trouvé</td></tr>
                                    @endforelse
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
