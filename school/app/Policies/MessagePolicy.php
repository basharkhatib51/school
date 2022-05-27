<?php

namespace App\Policies;

use App\Models\Generated\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MessagePolicy
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
        return $user->hasPermissionTo('Message List') ?
            Response::allow() : Response::deny('You don\'t have permission to show message list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Message $message
     * @return Response
     */
    public function view(User $user, Message $message): Response
    {
        return $user->hasPermissionTo('Message List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this message');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Message') ?
            Response::allow() : Response::deny('You don\'t have permission to create new message');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Message $message
     * @return Response
     */
    public function update(User $user, Message $message): Response
    {
        return $user->hasPermissionTo('Update Message') ?
            Response::allow() : Response::deny('You don\'t have permission to update this message');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Message $message
     * @return Response
     */
    public function delete(User $user, Message $message): Response
    {
        return $user->hasPermissionTo('Delete Message') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this message');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Message $message
     * @return Response
     */
    public function restore(User $user, Message $message): Response
        {
            return $user->hasPermissionTo('Restore Message') ||
            ($user->hasPermissionTo('Restore Message Owner') && $message->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this message');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any message');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Message List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
