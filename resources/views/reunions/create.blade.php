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
                                <h5>Nouvelle Réunion</h5>
                            </div>
                            <div class="card-block">
                                <form class="form-material" method="POST" action="{{ route('reunions.store') }}">
                                    @csrf

                                    <div class="form-group form-primary">
                                        <input type="text" name="titre" class="form-control" required>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Titre de la réunion</label>
                                    </div>

                                    <div class="form-group form-success">
                                        <input type="date" name="date" class="form-control" required>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Date</label>
                                    </div>

                                    <div class="form-group form-info">
                                        <input type="text" name="lieu" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Lieu</label>
                                    </div>

                                    <div class="form-group form-warning">
                                        <input type="time" name="heure_debut" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Heure début</label>
                                    </div>

                                    <div class="form-group form-danger">
                                        <input type="time" name="heure_fin" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Heure fin</label>
                                    </div>

                                    <div class="form-group form-default">
                                        <textarea name="ordre_du_jour" class="form-control" rows="3"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Ordre du jour</label>
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
