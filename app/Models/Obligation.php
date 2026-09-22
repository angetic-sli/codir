<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    use HasFactory;

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    protected $fillable = [
        'titre',
        'description',
        'type',
        'date_debut',
        'date_fin',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'obligation_user');
    }
}

