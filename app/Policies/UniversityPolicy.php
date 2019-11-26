<?php

namespace App\Policies;

use App\User;
use App\University;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any universities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the university.
     *
     * @param  \App\User  $user
     * @param  \App\University  $university
     * @return mixed
     */
    public function view(User $user, University $university)
    {
        //
    }

    /**
     * Determine whether the user can create universities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the university.
     *
     * @param  \App\User  $user
     * @param  \App\University  $university
     * @return mixed
     */
    public function update(User $user, University $university)
    {
        //
    }

    /**
     * Determine whether the user can delete the university.
     *
     * @param  \App\User  $user
     * @param  \App\University  $university
     * @return mixed
     */
    public function delete(User $user, University $university)
    {
        //
    }

    /**
     * Determine whether the user can restore the university.
     *
     * @param  \App\User  $user
     * @param  \App\University  $university
     * @return mixed
     */
    public function restore(User $user, University $university)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the university.
     *
     * @param  \App\User  $user
     * @param  \App\University  $university
     * @return mixed
     */
    public function forceDelete(User $user, University $university)
    {
        //
    }
}
