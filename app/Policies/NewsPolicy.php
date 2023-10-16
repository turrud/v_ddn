<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the news can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allnews');
    }

    /**
     * Determine whether the news can view the model.
     */
    public function view(User $user, News $model): bool
    {
        return $user->hasPermissionTo('view allnews');
    }

    /**
     * Determine whether the news can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allnews');
    }

    /**
     * Determine whether the news can update the model.
     */
    public function update(User $user, News $model): bool
    {
        return $user->hasPermissionTo('update allnews');
    }

    /**
     * Determine whether the news can delete the model.
     */
    public function delete(User $user, News $model): bool
    {
        return $user->hasPermissionTo('delete allnews');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allnews');
    }

    /**
     * Determine whether the news can restore the model.
     */
    public function restore(User $user, News $model): bool
    {
        return false;
    }

    /**
     * Determine whether the news can permanently delete the model.
     */
    public function forceDelete(User $user, News $model): bool
    {
        return false;
    }
}