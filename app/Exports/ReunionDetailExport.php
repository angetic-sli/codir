<?php

namespace App\Exports;

use App\Models\Reunion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReunionDetailExport implements WithMultipleSheets
{
    public function __construct(protected int $reunionId) {}

    public function sheets(): array
    {
        $reunion = Reunion::with(['taches.activite', 'taches.users'])
            ->findOrFail($this->reunionId);

        return [
            new ReunionInfoSheet($reunion),
            new TachesSheet($reunion),
        ];
    }
}

class ReunionInfoSheet implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(protected Reunion $reunion) {}

    public function collection()
    {
        return collect([[
            $this->reunion->titre,
            $this->reunion->date?->format('d/m/Y'),
            $this->reunion->lieu,
            $this->reunion->heure_debut,
            $this->reunion->heure_fin,
            $this->reunion->ordre_du_jour,
        ]]);
    }

    public function headings(): array
    {
        return ['Titre', 'Date', 'Lieu', 'Heure Début', 'Heure Fin', 'Ordre du Jour'];
    }

    public function title(): string { return 'Infos Réunion'; }
}

class TachesSheet implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(protected Reunion $reunion) {}

    public function collection()
    {
        return $this->reunion->taches->values()->map(function ($tache, $index) {
            return [
                $tache->ordre ?: ($index + 1),
                $tache->activite?->titre ?? 'Non spécifiée',
                $tache->titre,
                $tache->users->map(fn ($user) => $user->nom_complet)->implode(', '),
                $tache->recommandations,
                $tache->date_debut?->format('d/m/Y'),
                $tache->date_fin?->format('d/m/Y'),
                $tache->livrable,
                $tache->statut,
            ];
        });
    }

    public function headings(): array
    {
        return ['Ordre', 'Activité', 'Tâche', 'Acteurs', 'Recommandations', 'Date Début', 'Date Fin', 'Livrable', 'Statut'];
    }

    public function title(): string { return 'Tâches & Activités'; }
}
