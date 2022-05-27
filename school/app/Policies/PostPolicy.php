<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('Post List') ?
            Response::allow() : Response::deny('You don\'t have permission to show post list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response
     */
    public function view(User $user, Post $post): Response
    {
        return $user->hasPermissionTo('Post List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this post');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Post') ?
            Response::allow() : Response::deny('You don\'t have permission to create new post');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response
     */
    public function update(User $user, Post $post): Response
    {
        return $user->hasPermissionTo('Update Post') ?
            Response::allow() : Response::deny('You don\'t have permission to update this post');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response
     */
    public function delete(User $user, Post $post): Response
    {
        return $user->hasPermissionTo('Delete Post') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this post');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response
     */
    public function restore(User $user, Post $post): Response
        {
            return $user->hasPermissionTo('Restore Post') ||
            ($user->hasPermissionTo('Restore Post Owner') && $post->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this post');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any post');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Post List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
