@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Liste des CR Clientèle</h5>
                        <div class="mb-3 d-flex justify-content-end">

                            @can('cr-clienteles.create')<a href="{{ route('cr-clienteles.create') }}" class="btn btn-sm btn-primary">+ Nouveau CR</a>@endcan

                            @can('cr-clienteles.export')<form method="GET" action="{{ route('cr-clienteles.export.excel') }}" class="me-2">
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                <input type="hidden" name="statut" value="{{ request('statut') }}">
                                <button class="btn btn-success btn-sm"><i class="ti-export"></i> Export Excel</button>
                            </form>@endcan

                            @can('cr-clienteles.export')<form method="GET" action="{{ route('cr-clienteles.export.pdf') }}">
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                <input type="hidden" name="statut" value="{{ request('statut') }}">
                                <button class="btn btn-danger btn-sm"><i class="ti-file"></i> Export PDF</button>
                            </form>@endcan
                        </div>
                    </div>
                    <div class="card-block">

                        {{-- FILTRE --}}
                        <form method="GET" class="row mb-3">
                            <div class="col-md-3">
                                <label>Date début</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label>Date fin</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label>Statut</label>
                                <select name="statut" class="form-control">
                                    <option value="">Tous</option>
                                    <option value="Planifié" {{ request('statut')=='Planifié'?'selected':'' }}>Planifié</option>
                                    <option value="Effectué" {{ request('statut')=='Effectué'?'selected':'' }}>Effectué</option>
                                    <option value="Annulé" {{ request('statut')=='Annulé'?'selected':'' }}>Annulé</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button class="btn btn-secondary">Filtrer</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Agent</th>
                                        <th>Date</th>
                                        <th>Objet</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($crs as $cr)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cr->client->nom }}</td>
                                            <td>{{ $cr->user->nom }}</td>
                                            <td>{{ $cr->date_passage }}</td>
                                            <td>{{ $cr->objet }}</td>
                                            <td><span class="badge badge-info">{{ $cr->statut }}</span></td>
                                            <td>
                                                @can('cr-clienteles.view')<a href="{{ route('cr-clienteles.show', $cr->id) }}" class="btn btn-info btn-sm">Voir</a>@endcan
                                                @can('cr-clienteles.update')<a href="{{ route('cr-clienteles.edit', $cr->id) }}" class="btn btn-warning btn-sm">Modifier</a>@endcan
                                                @can('cr-clienteles.delete')<form action="{{ route('cr-clienteles.destroy', $cr->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce CR ?')">Supprimer</button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $crs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
