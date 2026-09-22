@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Liste des Obligations</h5>
                        @can('obligations.create')<a href="{{ route('obligations.create') }}" class="btn btn-sm btn-primary">+ Nouvelle Obligation</a>@endcan
                    </div>

                    {{-- 🔎 Filtres --}}
                    <div class="card-block">
                        <form method="GET" action="{{ route('obligations.index') }}" class="row g-3 mb-4">

                            <div class="col-md-3">
                                <label for="type" class="form-label">Type d'obligation</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">-- Tous les types --</option>
                                    <option value="Journalière" {{ request('type') == 'Journalière' ? 'selected' : '' }}>Journalière</option>
                                    <option value="Périodique" {{ request('type') == 'Périodique' ? 'selected' : '' }}>Périodique</option>
                                    <option value="CODIR" {{ request('type') == 'CODIR' ? 'selected' : '' }}>CODIR</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Date de début</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Date de fin</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="ti-filter"></i> Filtrer
                                </button>
                                <a href="{{ route('obligations.index') }}" class="btn btn-secondary">
                                    Réinitialiser
                                </a>
                            </div>
                        </form>
                    </div>

                    {{-- 📋 Tableau des obligations --}}
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employé</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($obligations as $obligation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $obligation->users->map(fn($user) => $user->nom_complet)->implode(', ') ?: '—' }}</td>
                                            <td><span class="badge badge-info">{{ $obligation->type }}</span></td>
                                            <td>{{ $obligation->description }}</td>
                                            <td>{{ $obligation->date_debut }}</td>
                                            <td>{{ $obligation->date_fin }}</td>
                                            <td>
                                                @can('obligations.update')<a href="{{ route('obligations.edit', $obligation->id) }}" class="btn btn-sm btn-warning">Modifier</a>@endcan
                                                @can('obligations.delete')<form action="{{ route('obligations.destroy', $obligation->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette obligation ?')">Supprimer</button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucune obligation trouvée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $obligations->appends(request()->query())->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
