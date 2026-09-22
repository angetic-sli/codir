<?php

namespace App\Exports;

use App\Models\Reunion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReunionsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Reunion::query()->orderByDesc('date')->orderByDesc('id')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Titre', 'Date', 'Lieu', 'Heure Début', 'Heure Fin', 'Ordre du Jour', 'Créé le', 'Modifié le'];
    }

    public function map($reunion): array
    {
        return [
            $reunion->id,
            $reunion->titre,
            $reunion->date?->format('d/m/Y'),
            $reunion->lieu,
            $reunion->heure_debut,
            $reunion->heure_fin,
            $reunion->ordre_du_jour,
            $reunion->created_at?->format('d/m/Y H:i'),
            $reunion->updated_at?->format('d/m/Y H:i'),
        ];
    }
}
