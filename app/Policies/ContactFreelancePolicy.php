<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactFreelance;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactFreelancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contactFreelance can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contactfreelances');
    }

    /**
     * Determine whether the contactFreelance can view the model.
     */
    public function view(User $user, ContactFreelance $model): bool
    {
        return $user->hasPermissionTo('view contactfreelances');
    }

    /**
     * Determine whether the contactFreelance can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contactfreelances');
    }

    /**
     * Determine whether the contactFreelance can update the model.
     */
    public function update(User $user, ContactFreelance $model): bool
    {
        return $user->hasPermissionTo('update contactfreelances');
    }

    /**
     * Determine whether the contactFreelance can delete the model.
     */
    public function delete(User $user, ContactFreelance $model): bool
    {
        return $user->hasPermissionTo('delete contactfreelances');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contactfreelances');
    }

    /**
     * Determine whether the contactFreelance can restore the model.
     */
    public function restore(User $user, ContactFreelance $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contactFreelance can permanently delete the model.
     */
    public function forceDelete(User $user, ContactFreelance $model): bool
    {
        return false;
    }
}
