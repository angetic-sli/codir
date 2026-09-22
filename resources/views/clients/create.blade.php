@extends('admin_layout.app')

@section('admin')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Nouveau Client</h5>
                        <a href="{{ route('clients.index') }}" class="btn btn-sm btn-secondary">Retour</a>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('clients.store') }}" method="POST" class="form-material">
                            @csrf

                            <div class="form-group form-primary">
                                <input type="text" name="nom" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Nom du client</label>
                            </div>

                            <div class="form-group form-primary">
                                <input type="email" name="email" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Email</label>
                            </div>

                            <div class="form-group form-primary">
                                <input type="text" name="contact" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Téléphone</label>
                            </div>

                            <div class="form-group form-primary">
                                <input type="text" name="ville" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Ville</label>
                            </div>

                            <div class="form-group form-primary">
                                <input type="text" name="pays" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Pays</label>
                            </div>

                            <div class="form-group form-primary">
                                <input type="text" name="secteur_activite" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Secteur d’activité</label>
                            </div>

                            <div class="form-group form-primary">
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
@endsection
