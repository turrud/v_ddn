<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceVirtualOffice;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceVirtualOfficePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the serviceVirtualOffice can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list servicevirtualoffices');
    }

    /**
     * Determine whether the serviceVirtualOffice can view the model.
     */
    public function view(User $user, ServiceVirtualOffice $model): bool
    {
        return $user->hasPermissionTo('view servicevirtualoffices');
    }

    /**
     * Determine whether the serviceVirtualOffice can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create servicevirtualoffices');
    }

    /**
     * Determine whether the serviceVirtualOffice can update the model.
     */
    public function update(User $user, ServiceVirtualOffice $model): bool
    {
        return $user->hasPermissionTo('update servicevirtualoffices');
    }

    /**
     * Determine whether the serviceVirtualOffice can delete the model.
     */
    public function delete(User $user, ServiceVirtualOffice $model): bool
    {
        return $user->hasPermissionTo('delete servicevirtualoffices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete servicevirtualoffices');
    }

    /**
     * Determine whether the serviceVirtualOffice can restore the model.
     */
    public function restore(User $user, ServiceVirtualOffice $model): bool
    {
        return false;
    }

    /**
     * Determine whether the serviceVirtualOffice can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceVirtualOffice $model): bool
    {
        return false;
    }
}
