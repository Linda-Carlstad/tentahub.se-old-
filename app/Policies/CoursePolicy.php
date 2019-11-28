<?php

namespace App\Policies;

use App\Association;
use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function view(User $user, Course $course)
    {
        return true;
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @param  \App\Association  $association
     * @return mixed
     */
    public function create(User $user, Association $association)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association === $association )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association->course === $course )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association->course === $course )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function restore(User $user, Course $course)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association->course === $course )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function forceDelete(User $user, Course $course)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association->course === $course )
        {
            return true;
        }
        return false;
    }
}
