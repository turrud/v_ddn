<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AboutAward;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutAwardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the aboutAward can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list aboutawards');
    }

    /**
     * Determine whether the aboutAward can view the model.
     */
    public function view(User $user, AboutAward $model): bool
    {
        return $user->hasPermissionTo('view aboutawards');
    }

    /**
     * Determine whether the aboutAward can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create aboutawards');
    }

    /**
     * Determine whether the aboutAward can update the model.
     */
    public function update(User $user, AboutAward $model): bool
    {
        return $user->hasPermissionTo('update aboutawards');
    }

    /**
     * Determine whether the aboutAward can delete the model.
     */
    public function delete(User $user, AboutAward $model): bool
    {
        return $user->hasPermissionTo('delete aboutawards');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete aboutawards');
    }

    /**
     * Determine whether the aboutAward can restore the model.
     */
    public function restore(User $user, AboutAward $model): bool
    {
        return false;
    }

    /**
     * Determine whether the aboutAward can permanently delete the model.
     */
    public function forceDelete(User $user, AboutAward $model): bool
    {
        return false;
    }
}
