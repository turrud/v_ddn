<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceWeddingDecoration;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceWeddingDecorationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the serviceWeddingDecoration can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list serviceweddingdecorations');
    }

    /**
     * Determine whether the serviceWeddingDecoration can view the model.
     */
    public function view(User $user, ServiceWeddingDecoration $model): bool
    {
        return $user->hasPermissionTo('view serviceweddingdecorations');
    }

    /**
     * Determine whether the serviceWeddingDecoration can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create serviceweddingdecorations');
    }

    /**
     * Determine whether the serviceWeddingDecoration can update the model.
     */
    public function update(User $user, ServiceWeddingDecoration $model): bool
    {
        return $user->hasPermissionTo('update serviceweddingdecorations');
    }

    /**
     * Determine whether the serviceWeddingDecoration can delete the model.
     */
    public function delete(User $user, ServiceWeddingDecoration $model): bool
    {
        return $user->hasPermissionTo('delete serviceweddingdecorations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete serviceweddingdecorations');
    }

    /**
     * Determine whether the serviceWeddingDecoration can restore the model.
     */
    public function restore(User $user, ServiceWeddingDecoration $model): bool
    {
        return false;
    }

    /**
     * Determine whether the serviceWeddingDecoration can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        ServiceWeddingDecoration $model
    ): bool {
        return false;
    }
}
