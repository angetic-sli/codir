@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Gestion des Permissions</h5>
                        @can('permissions.create')<a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm">+ Nouvelle Permission</a>@endcan
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($permissions as $permission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                @can('permissions.update')<a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Modifier</a>@endcan
                                                @can('permissions.delete')<form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette permission ?')">Supprimer</button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center">Aucune permission trouvée</td></tr>
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
