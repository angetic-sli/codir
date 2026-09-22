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
                        <h5>Liste des Réunions</h5>
                        <div class="card-header-right d-flex flex-wrap align-items-center" style="gap:8px;">
                            @can('reunions.export')<a href="{{ route('reunions.export.excel') }}" class="btn btn-sm btn-success" title="Télécharger toutes les réunions en Excel">
                                <i class="fa fa-file-excel-o"></i> Excel
                            </a>@endcan
                            @can('reunions.export')<a href="{{ route('reunions.export.pdf') }}" class="btn btn-sm btn-danger" title="Télécharger toutes les réunions en PDF">
                                <i class="fa fa-file-pdf-o"></i> PDF
                            </a>@endcan
                            @can('reunions.create')<a href="{{ route('reunions.create') }}" class="btn btn-sm btn-primary">+ Nouvelle Réunion</a>@endcan
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Date</th>
                                        <th>Lieu</th>
                                        <th>Ordre du jour</th>
                                        <th>Nombre de tâches</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reunions as $reunion)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $reunion->titre }}</td>
                                            <td>{{ $reunion->date }}</td>
                                            <td>{{ $reunion->lieu }}</td>
                                            <td>{{ Str::limit($reunion->ordre_du_jour, 30) }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ $reunion->taches_count ?? $reunion->taches->count() }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @can('reunions.view')<a href="{{ route('reunions.show', $reunion->id) }}" class="btn btn-sm btn-info" title="Voir">
                                                        <i class="fa fa-eye"></i>
                                                    </a>@endcan
                                                    @can('reunions.update')<a href="{{ route('reunions.edit', $reunion->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                        <i class="fa fa-edit"></i>
                                                    </a>@endcan
                                                    @can('reunions.export')<a href="{{ route('reunions.export.detail.excel', $reunion->id) }}" class="btn btn-sm btn-success" title="Télécharger cette réunion en Excel">
                                                        <i class="fa fa-file-excel-o"></i>
                                                    </a>
                                                    <a href="{{ route('reunions.export.detail.pdf', $reunion->id) }}" class="btn btn-sm btn-danger" title="Télécharger cette réunion en PDF">
                                                        <i class="fa fa-file-pdf-o"></i>
                                                    </a>@endcan
                                                    @can('reunions.duplicate')<form action="{{ route('reunions.duplicate', $reunion->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <input type="hidden" name="nouveau_titre" value="">
                                                        <button type="submit" class="btn btn-sm btn-secondary"
                                                                onclick="return prepareDuplicate(this, @js($reunion->titre));"
                                                                title="Dupliquer cette réunion">
                                                            <i class="fa fa-copy"></i>
                                                        </button>
                                                    </form>@endcan
                                                    @can('reunions.delete')<form action="{{ route('reunions.destroy', $reunion->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette réunion ?')" title="Supprimer">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>@endcan
                                                </div>
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

<script>
function prepareDuplicate(button, originalTitle) {
    const form = button.closest('form');
    const title = window.prompt('Titre de la nouvelle réunion :', originalTitle + ' - Copie');
    if (title === null) return false;
    form.querySelector('input[name="nouveau_titre"]').value = title.trim();
    return true;
}
</script>

<style>
.btn-group .btn {
    margin-right: 2px;
}
</style>
@endsection