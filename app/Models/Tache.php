<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    protected $fillable = [
        'titre',
        'recommandations',
        'date_debut',
        'date_fin',
        'livrable',
        'statut',
        'reunion_id',
        'activite_id',
        'ordre',
    ];

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function livrables()
    {
        return $this->hasMany(Livrable::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tache_user');
    }
}



