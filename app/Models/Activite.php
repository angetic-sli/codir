<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
    ];

    // Une activité a plusieurs tâches
    public function taches()
    {
        return $this->hasMany(Tache::class);
    }
}
