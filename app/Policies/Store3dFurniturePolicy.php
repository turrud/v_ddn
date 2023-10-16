<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Store3dFurniture;
use Illuminate\Auth\Access\HandlesAuthorization;

class Store3dFurniturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the store3dFurniture can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list store3dfurnitures');
    }

    /**
     * Determine whether the store3dFurniture can view the model.
     */
    public function view(User $user, Store3dFurniture $model): bool
    {
        return $user->hasPermissionTo('view store3dfurnitures');
    }

    /**
     * Determine whether the store3dFurniture can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create store3dfurnitures');
    }

    /**
     * Determine whether the store3dFurniture can update the model.
     */
    public function update(User $user, Store3dFurniture $model): bool
    {
        return $user->hasPermissionTo('update store3dfurnitures');
    }

    /**
     * Determine whether the store3dFurniture can delete the model.
     */
    public function delete(User $user, Store3dFurniture $model): bool
    {
        return $user->hasPermissionTo('delete store3dfurnitures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete store3dfurnitures');
    }

    /**
     * Determine whether the store3dFurniture can restore the model.
     */
    public function restore(User $user, Store3dFurniture $model): bool
    {
        return false;
    }

    /**
     * Determine whether the store3dFurniture can permanently delete the model.
     */
    public function forceDelete(User $user, Store3dFurniture $model): bool
    {
        return false;
    }
}
