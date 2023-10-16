<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactService;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contactService can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contactservices');
    }

    /**
     * Determine whether the contactService can view the model.
     */
    public function view(User $user, ContactService $model): bool
    {
        return $user->hasPermissionTo('view contactservices');
    }

    /**
     * Determine whether the contactService can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contactservices');
    }

    /**
     * Determine whether the contactService can update the model.
     */
    public function update(User $user, ContactService $model): bool
    {
        return $user->hasPermissionTo('update contactservices');
    }

    /**
     * Determine whether the contactService can delete the model.
     */
    public function delete(User $user, ContactService $model): bool
    {
        return $user->hasPermissionTo('delete contactservices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contactservices');
    }

    /**
     * Determine whether the contactService can restore the model.
     */
    public function restore(User $user, ContactService $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contactService can permanently delete the model.
     */
    public function forceDelete(User $user, ContactService $model): bool
    {
        return false;
    }
}
