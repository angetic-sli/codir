@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Profil de l'utilisateur</h5>
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="ti-arrow-left"></i> Retour à la liste
                                </a>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><strong>Nom complet :</strong> {{ $user->nom }} {{ $user->prenoms }}</h6>
                                        <h6><strong>Fonction :</strong> {{ $user->fonction ?? 'Non renseigné' }}</h6>
                                        <h6><strong>Contact :</strong> {{ $user->contact ?? 'Non renseigné' }}</h6>
                                        <h6><strong>Email :</strong> {{ $user->email }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6><strong>Date d’inscription :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</h6>
                                        <h6><strong>Dernière mise à jour :</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</h6>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><strong>Rôles attribués :</strong></h6>
                                        @if($user->roles->isNotEmpty())
                                            @foreach($user->roles as $role)
                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            <p><em>Aucun rôle attribué</em></p>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <h6><strong>Permissions :</strong></h6>
                                        @php
                                            $permissions = $user->getAllPermissions();
                                        @endphp
                                        @if($permissions->isNotEmpty())
                                            @foreach($permissions as $permission)
                                                <span class="badge badge-info">{{ $permission->name }}</span>
                                            @endforeach
                                        @else
                                            <p><em>Aucune permission attribuée</em></p>
                                        @endif
                                    </div>
                                </div>

                                <hr>

                                <div class="text-right">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                        <i class="ti-pencil"></i> Modifier
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">
                                            <i class="ti-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
