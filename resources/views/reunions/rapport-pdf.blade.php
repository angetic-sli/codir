<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport des Réunions</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; font-weight: bold; }
        .title { font-size: 16px; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">RAPPORT DES RÉUNIONS</div>
        <div>Généré le : {{ date('d/m/Y à H:i') }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Ordre du Jour</th>
                <th>Participants</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reunions as $reunion)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reunion->titre }}</td>
                <td>{{ $reunion->date?->format('d/m/Y') }}</td>
                <td>{{ $reunion->lieu }}</td>
                <td>{{ \Illuminate\Support\Str::limit($reunion->ordre_du_jour ?? '', 80) }}</td>
                <td>
                    @php
                        $participants = $reunion->participants;
                        if (is_string($participants)) {
                            $participants = json_decode($participants, true) ?? [];
                        }
                        if (!is_array($participants)) {
                            $participants = [];
                        }
                    @endphp
                    {{ implode(', ', $participants) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: center; font-size: 10px;">
        Total des réunions : {{ $reunions->count() }}
    </div>
</body>
</html>