<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    public function create(User $user)
    {

        return $user->hasPermissionTo('create-post');
    }

    public function update(User $user, Post $post)
    {

        return $user->hasPermissionTo('edit-post') && $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {

        return $user->hasPermissionTo('delete-post') && $user->id === $post->user_id;
    }
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
}
