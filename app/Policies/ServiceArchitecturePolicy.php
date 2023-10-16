<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceArchitecture;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceArchitecturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the serviceArchitecture can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list servicearchitectures');
    }

    /**
     * Determine whether the serviceArchitecture can view the model.
     */
    public function view(User $user, ServiceArchitecture $model): bool
    {
        return $user->hasPermissionTo('view servicearchitectures');
    }

    /**
     * Determine whether the serviceArchitecture can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create servicearchitectures');
    }

    /**
     * Determine whether the serviceArchitecture can update the model.
     */
    public function update(User $user, ServiceArchitecture $model): bool
    {
        return $user->hasPermissionTo('update servicearchitectures');
    }

    /**
     * Determine whether the serviceArchitecture can delete the model.
     */
    public function delete(User $user, ServiceArchitecture $model): bool
    {
        return $user->hasPermissionTo('delete servicearchitectures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete servicearchitectures');
    }

    /**
     * Determine whether the serviceArchitecture can restore the model.
     */
    public function restore(User $user, ServiceArchitecture $model): bool
    {
        return false;
    }

    /**
     * Determine whether the serviceArchitecture can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceArchitecture $model): bool
    {
        return false;
    }
}
