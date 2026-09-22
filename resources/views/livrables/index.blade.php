@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Liste des Livrables</h5>
                        <div class="card-header-right">
                            @can('livrables.create')<a href="{{ route('livrables.create') }}" class="btn btn-sm btn-primary">+ Nouveau Livrable</a>@endcan
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Date limite</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($livrables as $livrable)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $livrable->type ?: '—' }}</td>
                                            <td>{{ Str::limit($livrable->description, 50) }}</td>
                                            <td>{{ $livrable->tache?->date_fin?->format('d/m/Y') ?: '—' }}</td>
                                            <td>
                                                @can('livrables.view')<a href="{{ route('livrables.show', $livrable->id) }}" class="btn btn-sm btn-info">Voir</a>@endcan
                                                @can('livrables.update')<a href="{{ route('livrables.edit', $livrable->id) }}" class="btn btn-sm btn-warning">Modifier</a>@endcan
                                                @can('livrables.delete')<form action="{{ route('livrables.destroy', $livrable->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce livrable ?')">Supprimer</button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Aucun livrable trouvé.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $livrables->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
