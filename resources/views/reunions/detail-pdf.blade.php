<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Détail de la Réunion - {{ $reunion->titre }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .section { margin-bottom: 25px; }
        .section-title { background-color: #f2f2f2; padding: 8px; font-weight: bold; border-left: 4px solid #333; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        .table th { background-color: #f8f9fa; font-weight: bold; }
        .info-table { width: 100%; margin-bottom: 15px; }
        .info-table td { padding: 4px; vertical-align: top; }
        .info-table td:first-child { font-weight: bold; width: 25%; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h2>RAPPORT DÉTAILLÉ DE LA RÉUNION</h2>
        <h3>{{ $reunion->titre }}</h3>
        <p>Généré le : {{ date('d/m/Y à H:i') }}</p>
    </div>

    <!-- Section Informations de la réunion -->
    <div class="section">
        <div class="section-title">INFORMATIONS DE LA RÉUNION</div>
        <table class="info-table">
            <tr>
                <td>Titre :</td>
                <td>{{ $reunion->titre }}</td>
            </tr>
            <tr>
                <td>Date :</td>
                <td>{{ $reunion->date?->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Lieu :</td>
                <td>{{ $reunion->lieu }}</td>
            </tr>
            <tr>
                <td>Heure :</td>
                <td>{{ $reunion->heure_debut }} - {{ $reunion->heure_fin }}</td>
            </tr>
            <tr>
                <td>Ordre du jour :</td>
                <td>{{ $reunion->ordre_du_jour }}</td>
            </tr>
        </table>
    </div>

    <!-- Section Tâches et Activités -->
    <div class="section">
        <div class="section-title">TÂCHES ET ACTIVITÉS</div>
        @if($reunion->taches->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Ordre</th>
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
                    <td>{{ $tache->ordre ?? $loop->iteration }}</td>
                    <td>{{ $tache->activite->titre ?? 'Non spécifiée' }}</td>
                    <td>{{ $tache->titre }}</td>
                    <td>{{ $tache->users->map(fn($user) => $user->nom_complet)->implode(', ') }}</td>
                    <td>{{ $tache->recommandations }}</td>
                    <td>{{ $tache->date_debut?->format('d/m/Y') }}</td>
                    <td>{{ $tache->date_fin?->format('d/m/Y') }}</td>
                    <td>{{ $tache->livrable }}</td>
                    <td>{{ $tache->statut }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="text-align: center; font-style: italic; color: #666;">
            Aucune tâche associée à cette réunion.
        </p>
        @endif
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #666;">
        Document généré automatiquement - Total des tâches : {{ $reunion->taches->count() }}
    </div>
</body>
</html>