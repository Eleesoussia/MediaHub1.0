<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // === RELATIONS ===

    /** Un utilisateur a plusieurs publications */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    /** Un utilisateur a plusieurs commentaires */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    // === HELPERS ===

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}