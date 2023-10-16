<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StoreDecoration;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreDecorationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the storeDecoration can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list storedecorations');
    }

    /**
     * Determine whether the storeDecoration can view the model.
     */
    public function view(User $user, StoreDecoration $model): bool
    {
        return $user->hasPermissionTo('view storedecorations');
    }

    /**
     * Determine whether the storeDecoration can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create storedecorations');
    }

    /**
     * Determine whether the storeDecoration can update the model.
     */
    public function update(User $user, StoreDecoration $model): bool
    {
        return $user->hasPermissionTo('update storedecorations');
    }

    /**
     * Determine whether the storeDecoration can delete the model.
     */
    public function delete(User $user, StoreDecoration $model): bool
    {
        return $user->hasPermissionTo('delete storedecorations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete storedecorations');
    }

    /**
     * Determine whether the storeDecoration can restore the model.
     */
    public function restore(User $user, StoreDecoration $model): bool
    {
        return false;
    }

    /**
     * Determine whether the storeDecoration can permanently delete the model.
     */
    public function forceDelete(User $user, StoreDecoration $model): bool
    {
        return false;
    }
}
