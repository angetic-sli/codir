<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport CR Clientèle</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>📊 Rapport CR Clientèle</h2>
    <p>Période : {{ request('start_date') ?? '---' }} au {{ request('end_date') ?? '---' }}</p>

    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Agent</th>
                <th>Date</th>
                <th>Objet</th>
                <th>Actions Prévues</th>
                <th>Actions Réalisées</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($crs as $cr)
                <tr>
                    <td>{{ $cr->client->nom }}</td>
                    <td>{{ $cr->user->nom }}</td>
                    <td>{{ $cr->date_passage }}</td>
                    <td>{{ $cr->objet }}</td>
                    <td>{{ $cr->actions_prevues }}</td>
                    <td>{{ $cr->actions_realisees }}</td>
                    <td>{{ $cr->statut }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
