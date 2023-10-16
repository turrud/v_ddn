<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactCourse;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactCoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contactCourse can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contactcourses');
    }

    /**
     * Determine whether the contactCourse can view the model.
     */
    public function view(User $user, ContactCourse $model): bool
    {
        return $user->hasPermissionTo('view contactcourses');
    }

    /**
     * Determine whether the contactCourse can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contactcourses');
    }

    /**
     * Determine whether the contactCourse can update the model.
     */
    public function update(User $user, ContactCourse $model): bool
    {
        return $user->hasPermissionTo('update contactcourses');
    }

    /**
     * Determine whether the contactCourse can delete the model.
     */
    public function delete(User $user, ContactCourse $model): bool
    {
        return $user->hasPermissionTo('delete contactcourses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contactcourses');
    }

    /**
     * Determine whether the contactCourse can restore the model.
     */
    public function restore(User $user, ContactCourse $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contactCourse can permanently delete the model.
     */
    public function forceDelete(User $user, ContactCourse $model): bool
    {
        return false;
    }
}
