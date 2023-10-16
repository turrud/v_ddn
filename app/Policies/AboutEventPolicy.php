<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AboutEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the aboutEvent can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list aboutevents');
    }

    /**
     * Determine whether the aboutEvent can view the model.
     */
    public function view(User $user, AboutEvent $model): bool
    {
        return $user->hasPermissionTo('view aboutevents');
    }

    /**
     * Determine whether the aboutEvent can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create aboutevents');
    }

    /**
     * Determine whether the aboutEvent can update the model.
     */
    public function update(User $user, AboutEvent $model): bool
    {
        return $user->hasPermissionTo('update aboutevents');
    }

    /**
     * Determine whether the aboutEvent can delete the model.
     */
    public function delete(User $user, AboutEvent $model): bool
    {
        return $user->hasPermissionTo('delete aboutevents');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete aboutevents');
    }

    /**
     * Determine whether the aboutEvent can restore the model.
     */
    public function restore(User $user, AboutEvent $model): bool
    {
        return false;
    }

    /**
     * Determine whether the aboutEvent can permanently delete the model.
     */
    public function forceDelete(User $user, AboutEvent $model): bool
    {
        return false;
    }
}
