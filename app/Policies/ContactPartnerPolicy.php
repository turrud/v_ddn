<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactPartner;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPartnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contactPartner can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contactpartners');
    }

    /**
     * Determine whether the contactPartner can view the model.
     */
    public function view(User $user, ContactPartner $model): bool
    {
        return $user->hasPermissionTo('view contactpartners');
    }

    /**
     * Determine whether the contactPartner can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contactpartners');
    }

    /**
     * Determine whether the contactPartner can update the model.
     */
    public function update(User $user, ContactPartner $model): bool
    {
        return $user->hasPermissionTo('update contactpartners');
    }

    /**
     * Determine whether the contactPartner can delete the model.
     */
    public function delete(User $user, ContactPartner $model): bool
    {
        return $user->hasPermissionTo('delete contactpartners');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contactpartners');
    }

    /**
     * Determine whether the contactPartner can restore the model.
     */
    public function restore(User $user, ContactPartner $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contactPartner can permanently delete the model.
     */
    public function forceDelete(User $user, ContactPartner $model): bool
    {
        return false;
    }
}
