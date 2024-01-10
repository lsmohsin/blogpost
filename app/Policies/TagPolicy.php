<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    public function create(User $user)
    {

        return $user->hasPermissionTo('create-tag');
    }

    public function update(User $user, Tag $tag)
    {

        return $user->hasPermissionTo('edit-tag');
    }

    public function delete(User $user, Tag $tag)
    {

        return $user->hasPermissionTo('delete-tag');
    }
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
