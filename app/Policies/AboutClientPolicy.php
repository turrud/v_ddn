<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AboutClient;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the aboutClient can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list aboutclients');
    }

    /**
     * Determine whether the aboutClient can view the model.
     */
    public function view(User $user, AboutClient $model): bool
    {
        return $user->hasPermissionTo('view aboutclients');
    }

    /**
     * Determine whether the aboutClient can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create aboutclients');
    }

    /**
     * Determine whether the aboutClient can update the model.
     */
    public function update(User $user, AboutClient $model): bool
    {
        return $user->hasPermissionTo('update aboutclients');
    }

    /**
     * Determine whether the aboutClient can delete the model.
     */
    public function delete(User $user, AboutClient $model): bool
    {
        return $user->hasPermissionTo('delete aboutclients');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete aboutclients');
    }

    /**
     * Determine whether the aboutClient can restore the model.
     */
    public function restore(User $user, AboutClient $model): bool
    {
        return false;
    }

    /**
     * Determine whether the aboutClient can permanently delete the model.
     */
    public function forceDelete(User $user, AboutClient $model): bool
    {
        return false;
    }
}
