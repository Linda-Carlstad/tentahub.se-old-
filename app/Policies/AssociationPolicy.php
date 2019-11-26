<?php

namespace App\Policies;

use App\University;
use App\User;
use App\Association;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssociationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any associations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the association.
     *
     * @param  \App\User  $user
     * @param  \App\Association  $association
     * @return mixed
     */
    public function view(User $user, Association $association)
    {
        return true;
    }

    /**
     * Determine whether the user can create associations.
     *
     * @param  \App\User  $user
     * @param  \App\University  $university
     * @return mixed
     */
    public function create(User $user, University $university)
    {
        if( $user->role === 'super' || $user->role >= 'admin' && $user->university === $university )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the association.
     *
     * @param  \App\User  $user
     * @param  \App\Association  $association
     * @return mixed
     */
    public function update(User $user, Association $association)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association === $association )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the association.
     *
     * @param  \App\User  $user
     * @param  \App\Association  $association
     * @return mixed
     */
    public function delete(User $user, Association $association)
    {
        if( $user->role === 'super' || $user->role >= 'admin' && $user->association === $association )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the association.
     *
     * @param  \App\User  $user
     * @param  \App\Association  $association
     * @return mixed
     */
    public function restore(User $user, Association $association)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association === $association )
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the association.
     *
     * @param  \App\User  $user
     * @param  \App\Association  $association
     * @return mixed
     */
    public function forceDelete(User $user, Association $association)
    {
        if( $user->role === 'super' || $user->role >= 'moderator' && $user->association === $association )
        {
            return true;
        }
        return false;
    }
}
