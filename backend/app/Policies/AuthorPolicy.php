<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-author');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Author $author
     * @return bool
     */
    public function view(User $user, Author $author): bool
    {
        return $user->hasPermission('view-author');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('create-author');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->hasPermission('update-author');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission('delete-author');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Author $author
     * @return bool
     */
    public function restore(User $user, Author $author): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Author $author
     * @return bool
     */
    public function forceDelete(User $user, Author $author): bool
    {
        //
    }
}
