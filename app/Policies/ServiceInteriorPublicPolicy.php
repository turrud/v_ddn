<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceInteriorPublic;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceInteriorPublicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the serviceInteriorPublic can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list serviceinteriorpublics');
    }

    /**
     * Determine whether the serviceInteriorPublic can view the model.
     */
    public function view(User $user, ServiceInteriorPublic $model): bool
    {
        return $user->hasPermissionTo('view serviceinteriorpublics');
    }

    /**
     * Determine whether the serviceInteriorPublic can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create serviceinteriorpublics');
    }

    /**
     * Determine whether the serviceInteriorPublic can update the model.
     */
    public function update(User $user, ServiceInteriorPublic $model): bool
    {
        return $user->hasPermissionTo('update serviceinteriorpublics');
    }

    /**
     * Determine whether the serviceInteriorPublic can delete the model.
     */
    public function delete(User $user, ServiceInteriorPublic $model): bool
    {
        return $user->hasPermissionTo('delete serviceinteriorpublics');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete serviceinteriorpublics');
    }

    /**
     * Determine whether the serviceInteriorPublic can restore the model.
     */
    public function restore(User $user, ServiceInteriorPublic $model): bool
    {
        return false;
    }

    /**
     * Determine whether the serviceInteriorPublic can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceInteriorPublic $model): bool
    {
        return false;
    }
}
