<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StoreFlorist;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreFloristPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the storeFlorist can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list storeflorists');
    }

    /**
     * Determine whether the storeFlorist can view the model.
     */
    public function view(User $user, StoreFlorist $model): bool
    {
        return $user->hasPermissionTo('view storeflorists');
    }

    /**
     * Determine whether the storeFlorist can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create storeflorists');
    }

    /**
     * Determine whether the storeFlorist can update the model.
     */
    public function update(User $user, StoreFlorist $model): bool
    {
        return $user->hasPermissionTo('update storeflorists');
    }

    /**
     * Determine whether the storeFlorist can delete the model.
     */
    public function delete(User $user, StoreFlorist $model): bool
    {
        return $user->hasPermissionTo('delete storeflorists');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete storeflorists');
    }

    /**
     * Determine whether the storeFlorist can restore the model.
     */
    public function restore(User $user, StoreFlorist $model): bool
    {
        return false;
    }

    /**
     * Determine whether the storeFlorist can permanently delete the model.
     */
    public function forceDelete(User $user, StoreFlorist $model): bool
    {
        return false;
    }
}
