<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\Activite;
use App\Models\User;
use App\Models\Reunion;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index()
    {
        $taches = Tache::with('activite', 'users')->paginate(10);
        return view('taches.index', compact('taches'));
    }

    public function create()
    {
        $reunions = Reunion::all();
        $activites = Activite::all();
        $users = User::all();

        return view('taches.create', compact('reunions', 'activites', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'taches.*.titre' => 'required|string|max:255',
            'taches.*.recommandations' => 'nullable|string',
            'taches.*.date_debut' => 'nullable|date',
            'taches.*.date_fin' => 'nullable|date',
            'taches.*.livrable' => 'nullable|string',
            'taches.*.statut' => 'required|in:A faire,En cours,Terminé,En retard',
            'taches.*.reunion_id' => 'required|exists:reunions,id',
            'taches.*.activite_id' => 'required|exists:activites,id',
            'taches.*.users' => 'required|array|min:1',
            'taches.*.users.*' => 'integer|exists:users,id',
        ]);

        foreach ($request->taches as $tacheData) {
            $tache = Tache::create([
                'titre' => $tacheData['titre'],
                'recommandations' => $tacheData['recommandations'] ?? null,
                'date_debut' => $tacheData['date_debut'] ?? null,
                'date_fin' => $tacheData['date_fin'] ?? null,
                'livrable' => $tacheData['livrable'] ?? null,
                'statut' => $tacheData['statut'],
                'reunion_id' => $tacheData['reunion_id'],
                'activite_id' => $tacheData['activite_id'],
            ]);

            $tache->users()->attach($tacheData['users']);
        }

        return redirect()->route('taches.index')->with('success', 'Tâches créées avec succès.');
    }

    public function show(Tache $tache)
    {
        $tache->load(['reunion', 'activite', 'users']);
        return view('taches.show', compact('tache'));
    }

    public function edit(Tache $tache)
    {
        $tache->load('users');
        $users = User::all();
        $reunions = Reunion::all();
        $activites = Activite::all();

        return view('taches.edit', compact('tache', 'users', 'reunions', 'activites'));
    }

    public function update(Request $request, Tache $tache)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'recommandations' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'livrable' => 'nullable|string',
            'statut' => 'required|in:A faire,En cours,Terminé,En retard',
            'reunion_id' => 'required|exists:reunions,id',
            'activite_id' => 'required|exists:activites,id',
            'users' => 'nullable|array',
            'users.*' => 'integer|exists:users,id',
        ]);

        $tache->update([
            'titre' => $request->titre,
            'recommandations' => $request->recommandations,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'livrable' => $request->livrable,
            'statut' => $request->statut,
            'reunion_id' => $request->reunion_id,
            'activite_id' => $request->activite_id,
        ]);

        if ($request->has('users')) {
            $tache->users()->sync($request->users);
        } else {
            $tache->users()->sync([]);
        }

        return redirect()->route('taches.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Tache $tache)
    {
        $activiteId = $tache->activite_id;
        $tache->delete();
        
        return redirect()->route('activites.show', $activiteId)->with('success', 'Tâche supprimée avec succès');
    }
}