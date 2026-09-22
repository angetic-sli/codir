<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date',
        'lieu',
        'heure_debut',
        'heure_fin',
        'ordre_du_jour',
        'participants',
    ];

    protected $casts = [
        'date' => 'date',
        'participants' => 'array',
    ];

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class)->orderBy('ordre')->orderBy('id');
    }
}
