<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'publication_id',
        'user_id',
    ];

    // === RELATIONS ===

    /** Un commentaire appartient à une publication */
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    /** Un commentaire appartient à un auteur */
    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}