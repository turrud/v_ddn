<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StoreFurniture;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreFurniturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the storeFurniture can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list storefurnitures');
    }

    /**
     * Determine whether the storeFurniture can view the model.
     */
    public function view(User $user, StoreFurniture $model): bool
    {
        return $user->hasPermissionTo('view storefurnitures');
    }

    /**
     * Determine whether the storeFurniture can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create storefurnitures');
    }

    /**
     * Determine whether the storeFurniture can update the model.
     */
    public function update(User $user, StoreFurniture $model): bool
    {
        return $user->hasPermissionTo('update storefurnitures');
    }

    /**
     * Determine whether the storeFurniture can delete the model.
     */
    public function delete(User $user, StoreFurniture $model): bool
    {
        return $user->hasPermissionTo('delete storefurnitures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete storefurnitures');
    }

    /**
     * Determine whether the storeFurniture can restore the model.
     */
    public function restore(User $user, StoreFurniture $model): bool
    {
        return false;
    }

    /**
     * Determine whether the storeFurniture can permanently delete the model.
     */
    public function forceDelete(User $user, StoreFurniture $model): bool
    {
        return false;
    }
}
