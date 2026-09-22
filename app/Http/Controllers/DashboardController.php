<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reunion;
use App\Models\Activite;
use App\Models\Tache;

class DashboardController extends Controller
{
    public function index()
    {
        // Compteurs
        $usersCount     = User::count();
        $reunionsCount  = Reunion::count();
        $activitesCount = Activite::count();
        $tachesCount    = Tache::count();

        // Statuts des tâches
        $tachesAFaire   = Tache::where('statut', 'A faire')->count();
        $tachesEnCours  = Tache::where('statut', 'En cours')->count();
        $tachesTerminees= Tache::where('statut', 'Terminé')->count();
        $tachesEnRetard = Tache::where('statut', 'En retard')->count();

        // Dernières réunions avec activités
        $lastReunions = Reunion::latest()->take(5)->get();
        $lastActivites = Activite::latest()->take(5)->get();

        // Dernières tâches avec responsables
        $lastTaches = Tache::with('users')->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'usersCount',
            'reunionsCount',
            'activitesCount',
            'tachesCount',
            'tachesAFaire',
            'tachesEnCours',
            'tachesTerminees',
            'tachesEnRetard',
            'lastReunions',
            'lastActivites',
            'lastTaches'
        ));
    }
}
