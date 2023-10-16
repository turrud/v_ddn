<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Store3dBooth;
use Illuminate\Auth\Access\HandlesAuthorization;

class Store3dBoothPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the store3dBooth can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list store3dbooths');
    }

    /**
     * Determine whether the store3dBooth can view the model.
     */
    public function view(User $user, Store3dBooth $model): bool
    {
        return $user->hasPermissionTo('view store3dbooths');
    }

    /**
     * Determine whether the store3dBooth can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create store3dbooths');
    }

    /**
     * Determine whether the store3dBooth can update the model.
     */
    public function update(User $user, Store3dBooth $model): bool
    {
        return $user->hasPermissionTo('update store3dbooths');
    }

    /**
     * Determine whether the store3dBooth can delete the model.
     */
    public function delete(User $user, Store3dBooth $model): bool
    {
        return $user->hasPermissionTo('delete store3dbooths');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete store3dbooths');
    }

    /**
     * Determine whether the store3dBooth can restore the model.
     */
    public function restore(User $user, Store3dBooth $model): bool
    {
        return false;
    }

    /**
     * Determine whether the store3dBooth can permanently delete the model.
     */
    public function forceDelete(User $user, Store3dBooth $model): bool
    {
        return false;
    }
}
