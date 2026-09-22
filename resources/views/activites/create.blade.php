@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Nouvelle Activité</h5>
                            </div>
                            <div class="card-block">
                                <form class="form-material" method="POST" action="{{ route('activites.store') }}">
                                    @csrf
                                    <div class="form-group form-primary">
                                        <input type="text" name="titre" class="form-control" required>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Titre de l’activité</label>
                                    </div>

                                    <div class="form-group form-success">
                                        <textarea name="description" class="form-control" rows="3"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Description</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
