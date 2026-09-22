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
                        <h5>Détails de la Réunion</h5>
                        <div class="card-header-right">
                            @can('reunions.export')
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-download"></i> Télécharger
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('reunions.export.detail.excel', $reunion->id) }}">
                                        <i class="fa fa-file-excel-o"></i> Excel
                                    </a>
                                    <a class="dropdown-item" href="{{ route('reunions.export.detail.pdf', $reunion->id) }}">
                                        <i class="fa fa-file-pdf-o"></i> PDF
                                    </a>
                                </div>
                            </div>
                            @endcan
                            @can('reunions.update')<a href="{{ route('reunions.edit', $reunion->id) }}" class="btn btn-sm btn-warning">Modifier</a>@endcan
                            <a href="{{ route('reunions.index') }}" class="btn btn-sm btn-primary">Retour à la liste</a>
                        </div>
                    </div>
                    <div class="card-block">
                        <!-- Informations de la réunion -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informations Générales</h6>
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>Titre:</strong></td>
                                        <td>{{ $reunion->titre }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date:</strong></td>
                                        <td>{{ $reunion->date }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Lieu:</strong></td>
                                        <td>{{ $reunion->lieu }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Heure:</strong></td>
                                        <td>{{ $reunion->heure_debut }} - {{ $reunion->heure_fin }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Ordre du Jour</h6>
                                <div class="p-3 bg-light rounded">
                                    {{ $reunion->ordre_du_jour }}
                                </div>
                            </div>
                        </div>

                        <!-- Tâches associées -->
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Tâches Associées</h6>
                                @if($reunion->taches->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Activité</th>
                                                    <th>Tâche</th>
                                                    <th>Acteurs</th>
                                                    <th>Recommandations</th>
                                                    <th>Date Début</th>
                                                    <th>Date Fin</th>
                                                    <th>Livrable</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reunion->taches as $tache)
                                                <tr>
                                                    <td><span class="badge badge-light">{{ $tache->ordre ?? $loop->iteration }}</span></td>
                                                    <td>
                                                         @if($tache->activite)
                                                            <span class="badge badge-info">
                                                                {{ $tache->activite->titre }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $tache->titre }}</td>
                                                    <td>
                                                        @foreach($tache->users as $user)
                                                            <span class="badge badge-primary">{{ $user->nom }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $tache->recommandations }}</td>
                                                    <td>{{ $tache->date_debut }}</td>
                                                    <td>{{ $tache->date_fin }}</td>
                                                    <td>{{ $tache->livrable }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ 
                                                            $tache->statut == 'Terminé' ? 'success' : 
                                                            ($tache->statut == 'En cours' ? 'warning' : 
                                                            ($tache->statut == 'En retard' ? 'danger' : 'secondary'))
                                                        }}">
                                                            {{ $tache->statut }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        Aucune tâche associée à cette réunion.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection