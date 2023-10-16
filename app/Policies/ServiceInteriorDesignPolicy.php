<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceInteriorDesign;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceInteriorDesignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the serviceInteriorDesign can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list serviceinteriordesigns');
    }

    /**
     * Determine whether the serviceInteriorDesign can view the model.
     */
    public function view(User $user, ServiceInteriorDesign $model): bool
    {
        return $user->hasPermissionTo('view serviceinteriordesigns');
    }

    /**
     * Determine whether the serviceInteriorDesign can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create serviceinteriordesigns');
    }

    /**
     * Determine whether the serviceInteriorDesign can update the model.
     */
    public function update(User $user, ServiceInteriorDesign $model): bool
    {
        return $user->hasPermissionTo('update serviceinteriordesigns');
    }

    /**
     * Determine whether the serviceInteriorDesign can delete the model.
     */
    public function delete(User $user, ServiceInteriorDesign $model): bool
    {
        return $user->hasPermissionTo('delete serviceinteriordesigns');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete serviceinteriordesigns');
    }

    /**
     * Determine whether the serviceInteriorDesign can restore the model.
     */
    public function restore(User $user, ServiceInteriorDesign $model): bool
    {
        return false;
    }

    /**
     * Determine whether the serviceInteriorDesign can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceInteriorDesign $model): bool
    {
        return false;
    }
}
