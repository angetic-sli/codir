<?php

namespace App\Http\Controllers;

use App\Models\Livrable;
use App\Models\Tache;
use Illuminate\Http\Request;

class LivrableController extends Controller
{
    public function index()
    {
        $livrables = Livrable::with('tache')->paginate(10);
        return view('livrables.index', compact('livrables'));
    }

    public function create(Request $request)
    {
        $tache = $request->filled('tache_id') ? Tache::findOrFail($request->tache_id) : null;
        $taches = Tache::orderByDesc('id')->get();
        return view('livrables.create', compact('tache', 'taches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tache_id' => 'required|exists:taches,id',
            'type' => 'nullable|string|max:255',
            'fichier' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['tache_id','type','description']);

        if ($request->hasFile('fichier')) {
            $data['fichier_path'] = $request->file('fichier')->store('livrables', 'public');
        }

        Livrable::create($data);

        return redirect()->route('taches.show', $request->tache_id)->with('success', 'Livrable ajouté avec succès');
    }

    public function show(Livrable $livrable)
    {
        return view('livrables.show', compact('livrable'));
    }

    public function edit(Livrable $livrable)
    {
        return view('livrables.edit', compact('livrable'));
    }

    public function update(Request $request, Livrable $livrable)
    {
        $request->validate([
            'type' => 'nullable|string|max:255',
            'fichier' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['type','description']);

        if ($request->hasFile('fichier')) {
            if ($livrable->fichier_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($livrable->fichier_path);
            }
            $data['fichier_path'] = $request->file('fichier')->store('livrables', 'public');
        }

        $livrable->update($data);

        return redirect()->route('taches.show', $livrable->tache_id)->with('success', 'Livrable mis à jour avec succès');
    }

    public function destroy(Livrable $livrable)
    {
        $tacheId = $livrable->tache_id;
        $livrable->delete();
        return redirect()->route('taches.show', $tacheId)->with('success', 'Livrable supprimé avec succès');
    }
}
