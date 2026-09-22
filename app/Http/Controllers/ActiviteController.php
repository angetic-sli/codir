<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function index()
    {
        $activites = Activite::with('taches')->get();
        return view('activites.index', compact('activites'));
    }

    public function create()
    {
        return view('activites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Activite::create([
            'titre' => $request->titre,
            'description' => $request->description,
        ]);

        return redirect()->route('activites.index')->with('success', 'Activité créée avec succès');
    }

    public function show($id)
    {
        $activite = Activite::with(['taches.users', 'taches.reunion'])->findOrFail($id);
        return view('activites.show', compact('activite'));
    }

    public function edit($id)
    {
        $activite = Activite::findOrFail($id);
        return view('activites.edit', compact('activite'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $activite = Activite::findOrFail($id);
        $activite->update([
            'titre' => $request->titre,
            'description' => $request->description
        ]);

        return redirect()->route('activites.index')->with('success', 'Activité mise à jour avec succès');
    }

    public function destroy($id)
    {
        $activite = Activite::findOrFail($id);
        $activite->delete();
        
        return redirect()->route('activites.index')->with('success', 'Activité supprimée avec succès');
    }
}