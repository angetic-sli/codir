<?php

namespace App\Http\Controllers;

use App\Models\Obligation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObligationController extends Controller
{
    private const TYPES = ['Journalière', 'Périodique', 'CODIR'];

    public function index(Request $request)
    {
        $query = Obligation::with('users');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('date_debut', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date_fin', '<=', $request->end_date);
        }

        $obligations = $query->latest()->paginate(10)->withQueryString();

        return view('obligations.index', compact('obligations'));
    }

    public function create()
    {
        $users = User::orderBy('nom')->orderBy('prenoms')->get();
        $types = self::TYPES;
        return view('obligations.create', compact('users', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:' . implode(',', self::TYPES)],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'users' => ['required', 'array', 'min:1'],
            'users.*' => ['integer', 'exists:users,id'],
        ]);

        DB::transaction(function () use ($data) {
            $userIds = $data['users'];
            unset($data['users']);
            $obligation = Obligation::create($data);
            $obligation->users()->sync($userIds);
        });

        return redirect()->route('obligations.index')->with('success', 'Obligation créée avec succès.');
    }

    public function edit(Obligation $obligation)
    {
        $obligation->load('users');
        $users = User::orderBy('nom')->orderBy('prenoms')->get();
        $types = self::TYPES;
        return view('obligations.edit', compact('obligation', 'users', 'types'));
    }

    public function update(Request $request, Obligation $obligation)
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:' . implode(',', self::TYPES)],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'users' => ['required', 'array', 'min:1'],
            'users.*' => ['integer', 'exists:users,id'],
        ]);

        DB::transaction(function () use ($data, $obligation) {
            $userIds = $data['users'];
            unset($data['users']);
            $obligation->update($data);
            $obligation->users()->sync($userIds);
        });

        return redirect()->route('obligations.index')->with('success', 'Obligation mise à jour avec succès.');
    }

    public function destroy(Obligation $obligation)
    {
        $obligation->delete();
        return redirect()->route('obligations.index')->with('success', 'Obligation supprimée avec succès.');
    }
}
