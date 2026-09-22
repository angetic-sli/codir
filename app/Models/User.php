<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Les attributs pouvant être remplis en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenoms',
        'fonction',
        'contact',
        'email',
        'password',
    ];

    /**
     * Les attributs à masquer lors de la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs devant être castés.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * 🔐 Mutateur : formater le nom en majuscules.
     */
    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = strtoupper($value);
    }

    /**
     * 🧑 Relation : un utilisateur peut avoir plusieurs présences.
     */
    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

    /**
     * 🧾 Relation Many-to-Many : un utilisateur peut être lié à plusieurs tâches.
     */
    public function taches()
    {
        return $this->belongsToMany(Tache::class, 'tache_user')
                    ->withTimestamps();
    }

    /**
     * 👤 Accesseur : retourne le nom complet
     */
    public function getNomCompletAttribute()
    {
        return trim($this->nom . ' ' . $this->prenoms);
    }

    /**
     * Vérifie si l'utilisateur est un admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Vérifie si l'utilisateur est un membre du CODIR
     */
    public function isMembreCodir()
    {
        return $this->hasRole('membre_codir');
    }

    public function obligations()
    {
        return $this->belongsToMany(Obligation::class, 'obligation_user');
    }
}
