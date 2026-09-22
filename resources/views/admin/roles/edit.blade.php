@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Modifier le rôle : {{ $role->name }}</h5>
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">Retour</a>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST" class="form-material">
                            @csrf
                            @method('PUT')

                            <div class="form-group form-primary">
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Nom du rôle</label>
                            </div>

                            <h6>Permissions disponibles</h6>

                            {{-- ✅ Tout sélectionner --}}
                            <div class="checkbox mb-2">
                                <label>
                                    <input type="checkbox" id="select-all">
                                    <strong>Tout sélectionner / Tout décocher</strong>
                                </label>
                            </div>

                            {{-- ✅ Liste des permissions --}}
                            <div class="mb-3">
                                @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @can('roles.update')<button type="submit" class="btn btn-primary">Mettre à jour</button>@endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="permissions[]"]');

    selectAll.addEventListener('change', function(e) {
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });

    // ✅ Si toutes sont cochées au chargement, on coche aussi "Tout sélectionner"
    window.addEventListener('load', () => {
        const total = checkboxes.length;
        const checked = Array.from(checkboxes).filter(c => c.checked).length;
        if (total > 0 && total === checked) selectAll.checked = true;
    });
</script>
@endpush
@endsection
