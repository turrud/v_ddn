<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Store3dArchitecture;
use Illuminate\Auth\Access\HandlesAuthorization;

class Store3dArchitecturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the store3dArchitecture can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list store3darchitectures');
    }

    /**
     * Determine whether the store3dArchitecture can view the model.
     */
    public function view(User $user, Store3dArchitecture $model): bool
    {
        return $user->hasPermissionTo('view store3darchitectures');
    }

    /**
     * Determine whether the store3dArchitecture can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create store3darchitectures');
    }

    /**
     * Determine whether the store3dArchitecture can update the model.
     */
    public function update(User $user, Store3dArchitecture $model): bool
    {
        return $user->hasPermissionTo('update store3darchitectures');
    }

    /**
     * Determine whether the store3dArchitecture can delete the model.
     */
    public function delete(User $user, Store3dArchitecture $model): bool
    {
        return $user->hasPermissionTo('delete store3darchitectures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete store3darchitectures');
    }

    /**
     * Determine whether the store3dArchitecture can restore the model.
     */
    public function restore(User $user, Store3dArchitecture $model): bool
    {
        return false;
    }

    /**
     * Determine whether the store3dArchitecture can permanently delete the model.
     */
    public function forceDelete(User $user, Store3dArchitecture $model): bool
    {
        return false;
    }
}
