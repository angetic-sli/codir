@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Créer un nouveau Rôle</h5>
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">Retour</a>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('roles.store') }}" method="POST" class="form-material">
                            @csrf

                            <div class="form-group form-primary">
                                <input type="text" name="name" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Nom du rôle</label>
                            </div>

                            <h6>Permissions disponibles</h6>

                            {{-- ✅ Tout sélectionner / décocher --}}
                            <div class="checkbox mb-2">
                                <label>
                                    <input type="checkbox" id="select-all">
                                    <strong>Tout sélectionner / Tout décocher</strong>
                                </label>
                            </div>

                            <div class="mb-3">
                                @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @can('roles.create')<button type="submit" class="btn btn-primary">Enregistrer</button>@endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ✅ Script --}}
@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });
</script>
@endpush
@endsection
