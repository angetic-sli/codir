<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livrable extends Model
{
    use HasFactory;

    protected $fillable = [
        'tache_id',
        'type',
        'description',
        'fichier_path',
    ];

    // Un livrable appartient à une tâche
    public function tache()
    {
        return $this->belongsTo(Tache::class);
    }
}
