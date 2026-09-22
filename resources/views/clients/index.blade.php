@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Liste des Clients</h5>
                        @can('clients.create')
                        <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary">+ Nouveau Client</a>
                        @endcan
                    </div>

                    <div class="card-block">
                        {{-- 📌 Barre de recherche et filtres --}}
                        <form method="GET" action="{{ route('clients.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher par nom, email ou secteur...">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="ville" class="form-control">
                                        <option value="">Toutes les villes</option>
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville }}" {{ request('ville') == $ville ? 'selected' : '' }}>
                                                {{ $ville }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_debut" value="{{ request('date_debut') }}" class="form-control" placeholder="Du">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_fin" value="{{ request('date_fin') }}" class="form-control" placeholder="Au">
                                </div>
                                <div class="col-md-1 mb-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <i class="ti-search"></i>
                                    </button>
                                </div>
                                <div class="col-md-2 mb-2 d-flex gap-2">
                                    <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm ms-2">
                                        Réinitialiser
                                    </a>
                                </div>
                            </div>
                        </form>

                        {{-- 📊 Tableau des clients --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Ville</th>
                                        <th>Secteur</th>
                                        <th>Créé le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($clients as $client)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $client->nom }}</td>
                                            <td>{{ $client->contact }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->ville }}</td>
                                            <td>{{ $client->secteur_activite }}</td>
                                            <td>{{ $client->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @can('clients.view')<a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info">Voir</a>@endcan
                                                @can('clients.update')<a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Modifier</a>@endcan
                                                @can('clients.delete')<form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
                                                </form>@endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Aucun client trouvé</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-end mt-3">
                                {{ $clients->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
