<?php

namespace App\Exports;

use App\Models\Tache;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CodirExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(private array $filters = []) {}

    public function collection()
    {
        return Tache::with(['activite', 'reunion', 'users'])
            ->when(!empty($this->filters['date_debut']), fn ($q) => $q->whereDate('date_debut', '>=', $this->filters['date_debut']))
            ->when(!empty($this->filters['date_fin']), fn ($q) => $q->whereDate('date_fin', '<=', $this->filters['date_fin']))
            ->when(!empty($this->filters['statut']), fn ($q) => $q->where('statut', $this->filters['statut']))
            ->when(!empty($this->filters['activite_id']), fn ($q) => $q->where('activite_id', $this->filters['activite_id']))
            ->when(!empty($this->filters['reunion_id']), fn ($q) => $q->where('reunion_id', $this->filters['reunion_id']))
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return ['Réunion', 'Date réunion', 'Activité', 'Tâche', 'Responsables', 'Date début', 'Date fin', 'Statut', 'Livrable', 'Recommandations'];
    }

    public function map($tache): array
    {
        return [
            $tache->reunion?->titre,
            optional($tache->reunion?->date)->format('Y-m-d'),
            $tache->activite?->titre,
            $tache->titre,
            $tache->users->map(fn ($u) => $u->nom_complet)->implode(', '),
            optional($tache->date_debut)->format('Y-m-d'),
            optional($tache->date_fin)->format('Y-m-d'),
            $tache->statut,
            $tache->livrable,
            $tache->recommandations,
        ];
    }
}
