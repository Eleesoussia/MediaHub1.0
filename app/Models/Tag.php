<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
    ];

    // === RELATIONS ===

    /** Un tag concerne plusieurs publications */
    public function publications()
    {
        return $this->belongsToMany(Publication::class);
    }
}