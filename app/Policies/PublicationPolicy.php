<?php

namespace App\Policies;

use App\Models\Publication;
use App\Models\User;

class PublicationPolicy
{
    /**
     * Détermine si l'utilisateur peut voir la liste des publications.
     * → Toujours vrai (les publications sont publiques).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Détermine si l'utilisateur peut voir une publication.
     * → Toujours vrai (les publications sont publiques).
     */
    public function view(User $user, Publication $publication): bool
    {
        return true;
    }

    /**
     * Détermine si l'utilisateur peut créer une publication.
     * → Tout utilisateur connecté peut créer.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Détermine si l'utilisateur peut modifier une publication.
     * → Propriétaire OU admin.
     */
    public function update(User $user, Publication $publication): bool
    {
        return $user->id === $publication->user_id || $user->role === 'admin';
    }

    /**
     * Détermine si l'utilisateur peut supprimer une publication.
     * → Même règle que update.
     */
    public function delete(User $user, Publication $publication): bool
    {
        return $this->update($user, $publication);
    }

    /**
     * Détermine si l'utilisateur peut restaurer (soft delete).
     * → Admin uniquement (TP11).
     */
    public function restore(User $user, Publication $publication): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Détermine si l'utilisateur peut supprimer définitivement.
     * → Admin uniquement (TP11).
     */
    public function forceDelete(User $user, Publication $publication): bool
    {
        return $user->role === 'admin';
    }
}