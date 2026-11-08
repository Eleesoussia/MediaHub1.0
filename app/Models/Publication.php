<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'contenu',
        'categorie_id',
        'user_id',
        'image',
        'fichier_media',
        'type_media',
    ];

    // === RELATIONS ===

    /** Une publication appartient à une catégorie */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /** Une publication appartient à un auteur */
    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Une publication a plusieurs commentaires */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    /** Une publication a plusieurs tags (many-to-many) */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // === ACCESSORS (TP9) ===

    public function getUrlImageAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getUrlMediaAttribute(): ?string
    {
        return $this->fichier_media ? Storage::url($this->fichier_media) : null;
    }
}