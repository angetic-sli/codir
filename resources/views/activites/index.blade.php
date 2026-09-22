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
                        <h5>Liste des Activités</h5>
                        <span>Activités liées aux réunions</span>
                        <div class="card-header-right">
                            @can('activites.create')
                            <a href="{{ route('activites.create', ['reunion' => request('reunion_id')]) }}" class="btn btn-sm btn-primary">+ Nouvelle Activité</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activites as $activite)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $activite->titre }}</td>
                                            <td>{{ Str::limit($activite->description, 40) }}</td>
                                            <td>
                                                @can('activites.update')<a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-sm btn-warning">Modifier</a>@endcan
                                                @can('activites.delete')<form action="{{ route('activites.destroy', $activite->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette activité ?')">Supprimer</button>
                                                </form>@endcan
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
