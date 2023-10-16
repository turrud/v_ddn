<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AboutPeople;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPeoplePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the aboutPeople can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allaboutpeople');
    }

    /**
     * Determine whether the aboutPeople can view the model.
     */
    public function view(User $user, AboutPeople $model): bool
    {
        return $user->hasPermissionTo('view allaboutpeople');
    }

    /**
     * Determine whether the aboutPeople can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allaboutpeople');
    }

    /**
     * Determine whether the aboutPeople can update the model.
     */
    public function update(User $user, AboutPeople $model): bool
    {
        return $user->hasPermissionTo('update allaboutpeople');
    }

    /**
     * Determine whether the aboutPeople can delete the model.
     */
    public function delete(User $user, AboutPeople $model): bool
    {
        return $user->hasPermissionTo('delete allaboutpeople');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allaboutpeople');
    }

    /**
     * Determine whether the aboutPeople can restore the model.
     */
    public function restore(User $user, AboutPeople $model): bool
    {
        return false;
    }

    /**
     * Determine whether the aboutPeople can permanently delete the model.
     */
    public function forceDelete(User $user, AboutPeople $model): bool
    {
        return false;
    }
}
