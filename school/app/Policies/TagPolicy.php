<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TagPolicy
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
        return $user->hasPermissionTo('Tag List') ?
            Response::allow() : Response::deny('You don\'t have permission to show tag list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function view(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Tag List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this tag');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to create new tag');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function update(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Update Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to update this tag');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function delete(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Delete Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this tag');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function restore(User $user, Tag $tag): Response
        {
            return $user->hasPermissionTo('Restore Tag') ||
            ($user->hasPermissionTo('Restore Tag Owner') && $tag->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this tag');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any tag');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Tag List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
