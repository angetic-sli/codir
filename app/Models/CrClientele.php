<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrClientele extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'date_passage',
        'objet',
        'compte_rendu',
        'actions_prevues',
        'actions_realisees',
        'statut',
    ];

    protected $casts = [
        'date_passage' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
