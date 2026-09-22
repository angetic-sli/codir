<?php

namespace App\Exports;

use App\Models\CrClientele;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class CrClienteleExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = CrClientele::with(['client', 'user']);

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $query->whereBetween('date_passage', [$this->request->start_date, $this->request->end_date]);
        }

        if ($this->request->filled('user_id')) {
            $query->where('user_id', $this->request->user_id);
        }

        if ($this->request->filled('statut')) {
            $query->where('statut', $this->request->statut);
        }

        return $query->get()->map(function ($cr) {
            return [
                'Client' => $cr->client?->nom,
                'Agent' => $cr->user?->nom_complet,
                'Date Passage' => $cr->date_passage,
                'Objet' => $cr->objet,
                'Actions Prévues' => $cr->actions_prevues,
                'Actions Réalisées' => $cr->actions_realisees,
                'Statut' => $cr->statut,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Client',
            'Agent',
            'Date Passage',
            'Objet',
            'Actions Prévues',
            'Actions Réalisées',
            'Statut'
        ];
    }
}
