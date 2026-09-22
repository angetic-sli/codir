@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Modifier la Permission</h5>
                        <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-secondary">Retour</a>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="form-material">
                            @csrf
                            @method('PUT')

                            <div class="form-group form-primary">
                                <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Nom de la permission</label>
                            </div>

                            @can('permissions.update')<button type="submit" class="btn btn-success">Mettre à jour</button>@endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
