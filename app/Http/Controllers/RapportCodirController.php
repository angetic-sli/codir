<?php

namespace App\Http\Controllers;

use App\Exports\CodirExport;
use App\Models\Activite;
use App\Models\Reunion;
use App\Models\Tache;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RapportCodirController extends Controller
{
    private const STATUTS = ['A faire', 'En cours', 'Terminé', 'En retard'];

    public function index(Request $request)
    {
        $taches = $this->getFilteredQuery($request)->paginate(20)->withQueryString();
        $stats = $this->getStats($request);
        $activites = Activite::orderBy('titre')->get();
        $reunions = Reunion::latest('date')->get();
        $statuts = self::STATUTS;

        return view('rapports.codir.index', compact('taches', 'stats', 'activites', 'reunions', 'statuts'));
    }

    public function exportExcel(Request $request)
    {
        $filters = $request->only(['date_debut', 'date_fin', 'statut', 'activite_id', 'reunion_id']);
        return Excel::download(new CodirExport($filters), 'rapport-codir-' . now()->format('Y-m-d') . '.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $taches = $this->getFilteredQuery($request)->get();
        $stats = $this->getStats($request);
        $filters = $request->only(['date_debut', 'date_fin', 'statut', 'activite_id', 'reunion_id']);

        $pdf = Pdf::loadView('rapports.codir.pdf', compact('taches', 'stats', 'filters'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('rapport-codir-' . now()->format('Y-m-d') . '.pdf');
    }

    public function getFilteredQuery(Request $request)
    {
        $query = Tache::with(['activite', 'reunion', 'users'])
            ->when($request->filled('date_debut'), fn ($q) => $q->whereDate('date_debut', '>=', $request->date_debut))
            ->when($request->filled('date_fin'), fn ($q) => $q->whereDate('date_fin', '<=', $request->date_fin))
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->statut))
            ->when($request->filled('activite_id'), fn ($q) => $q->where('activite_id', $request->activite_id))
            ->when($request->filled('reunion_id'), fn ($q) => $q->where('reunion_id', $request->reunion_id));

        return $query->latest();
    }

    private function getStats(Request $request): array
    {
        $query = Tache::query()
            ->when($request->filled('date_debut'), fn ($q) => $q->whereDate('date_debut', '>=', $request->date_debut))
            ->when($request->filled('date_fin'), fn ($q) => $q->whereDate('date_fin', '<=', $request->date_fin))
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->statut))
            ->when($request->filled('activite_id'), fn ($q) => $q->where('activite_id', $request->activite_id))
            ->when($request->filled('reunion_id'), fn ($q) => $q->where('reunion_id', $request->reunion_id));

        return [
            'total' => (clone $query)->count(),
            'a_faire' => (clone $query)->where('statut', 'A faire')->count(),
            'en_cours' => (clone $query)->where('statut', 'En cours')->count(),
            'termine' => (clone $query)->where('statut', 'Terminé')->count(),
            'en_retard' => (clone $query)->where('statut', 'En retard')->count(),
        ];
    }
}
