<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Se l'utente è un membro di un progetto allora lo portà visualizzare
     */
    public function view(User $user, Project $project): bool
    {
        return $user->memberships->contains($project);
    }

    /**
     * Determine whether the user can create models.
     * Se l'utente è loggato allora può creare progetti
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * Un progetto potrà essere modificato solo dal creatore
     */
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->creator_id;
    }

    /**
     * Determine whether the user can delete the model.
     * Un progetto potrà essere eliminato solo dal creatore
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->creator_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        //
    }
}
