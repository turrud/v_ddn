<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactInvest;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactInvestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contactInvest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contactinvests');
    }

    /**
     * Determine whether the contactInvest can view the model.
     */
    public function view(User $user, ContactInvest $model): bool
    {
        return $user->hasPermissionTo('view contactinvests');
    }

    /**
     * Determine whether the contactInvest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contactinvests');
    }

    /**
     * Determine whether the contactInvest can update the model.
     */
    public function update(User $user, ContactInvest $model): bool
    {
        return $user->hasPermissionTo('update contactinvests');
    }

    /**
     * Determine whether the contactInvest can delete the model.
     */
    public function delete(User $user, ContactInvest $model): bool
    {
        return $user->hasPermissionTo('delete contactinvests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contactinvests');
    }

    /**
     * Determine whether the contactInvest can restore the model.
     */
    public function restore(User $user, ContactInvest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contactInvest can permanently delete the model.
     */
    public function forceDelete(User $user, ContactInvest $model): bool
    {
        return false;
    }
}
