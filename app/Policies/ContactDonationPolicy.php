<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactDonation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactDonationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contactDonation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contactdonations');
    }

    /**
     * Determine whether the contactDonation can view the model.
     */
    public function view(User $user, ContactDonation $model): bool
    {
        return $user->hasPermissionTo('view contactdonations');
    }

    /**
     * Determine whether the contactDonation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contactdonations');
    }

    /**
     * Determine whether the contactDonation can update the model.
     */
    public function update(User $user, ContactDonation $model): bool
    {
        return $user->hasPermissionTo('update contactdonations');
    }

    /**
     * Determine whether the contactDonation can delete the model.
     */
    public function delete(User $user, ContactDonation $model): bool
    {
        return $user->hasPermissionTo('delete contactdonations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contactdonations');
    }

    /**
     * Determine whether the contactDonation can restore the model.
     */
    public function restore(User $user, ContactDonation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contactDonation can permanently delete the model.
     */
    public function forceDelete(User $user, ContactDonation $model): bool
    {
        return false;
    }
}
