<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceBoothDesign;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceBoothDesignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the serviceBoothDesign can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list serviceboothdesigns');
    }

    /**
     * Determine whether the serviceBoothDesign can view the model.
     */
    public function view(User $user, ServiceBoothDesign $model): bool
    {
        return $user->hasPermissionTo('view serviceboothdesigns');
    }

    /**
     * Determine whether the serviceBoothDesign can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create serviceboothdesigns');
    }

    /**
     * Determine whether the serviceBoothDesign can update the model.
     */
    public function update(User $user, ServiceBoothDesign $model): bool
    {
        return $user->hasPermissionTo('update serviceboothdesigns');
    }

    /**
     * Determine whether the serviceBoothDesign can delete the model.
     */
    public function delete(User $user, ServiceBoothDesign $model): bool
    {
        return $user->hasPermissionTo('delete serviceboothdesigns');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete serviceboothdesigns');
    }

    /**
     * Determine whether the serviceBoothDesign can restore the model.
     */
    public function restore(User $user, ServiceBoothDesign $model): bool
    {
        return false;
    }

    /**
     * Determine whether the serviceBoothDesign can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceBoothDesign $model): bool
    {
        return false;
    }
}
