<?php

namespace App\Http\Controllers;

use App\Models\CrClientele;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CrClienteleExport;
use Barryvdh\DomPDF\Facade\Pdf;

class CrClienteleController extends Controller
{
    public function index(Request $request)
    {
        $query = CrClientele::with(['client', 'user']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date_passage', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $users = User::all();
        $crs = $query->latest()->paginate(10);

        return view('cr_clienteles.index', compact('crs', 'users'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new CrClienteleExport($request), 'cr_clienteles.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = CrClientele::with(['client', 'user']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date_passage', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $crs = $query->latest()->get();
        $pdf = Pdf::loadView('cr_clienteles.export_pdf', compact('crs'));
        return $pdf->download('cr_clienteles.pdf');
    }

    public function create()
    {
        $clients = Client::all();
        $users = User::all();
        return view('cr_clienteles.create', compact('clients', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'date_passage' => 'required|date',
            'objet' => 'nullable|string',
            'compte_rendu' => 'required|string',
            'actions_prevues' => 'nullable|string',
            'actions_realisees' => 'nullable|string',
            'statut' => 'required|in:Planifié,Effectué,Annulé'
        ]);

        CrClientele::create($data);
        return redirect()->route('cr-clienteles.index')->with('success', 'CR Clientèle créé avec succès.');
    }

    public function show(CrClientele $crClientele)
    {
        return view('cr_clienteles.show', compact('crClientele'));
    }

    public function edit($id)
    {
        $crClientele = CrClientele::findOrFail($id);
        $clients = Client::all();
        $users = User::all();
        return view('cr_clienteles.edit', compact('crClientele', 'clients', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'date_passage' => 'required|date',
            'objet' => 'nullable|string',
            'compte_rendu' => 'nullable|string',
            'actions_prevues' => 'nullable|string',
            'actions_realisees' => 'nullable|string',
            'statut' => 'required|in:Planifié,Effectué,Annulé',
        ]);

        $crClientele = CrClientele::findOrFail($id);
        $crClientele->update($data);

        return redirect()->route('cr-clienteles.index')->with('success', 'CR Clientèle mis à jour avec succès.');
    }

    public function destroy(CrClientele $crClientele)
    {
        $crClientele->delete();
        return redirect()->route('cr-clienteles.index')->with('success', 'CR Clientèle supprimé.');
    }
}
