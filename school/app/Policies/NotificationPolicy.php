<?php

namespace App\Policies;

use App\Models\Generated\Notification;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
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
        return $user->hasPermissionTo('Notification List') ?
            Response::allow() : Response::deny('You don\'t have permission to show notification list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Notification $notification
     * @return Response
     */
    public function view(User $user, Notification $notification): Response
    {
        return $user->hasPermissionTo('Notification List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this notification');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Notification') ?
            Response::allow() : Response::deny('You don\'t have permission to create new notification');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Notification $notification
     * @return Response
     */
    public function update(User $user, Notification $notification): Response
    {
        return $user->hasPermissionTo('Update Notification') ?
            Response::allow() : Response::deny('You don\'t have permission to update this notification');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Notification $notification
     * @return Response
     */
    public function delete(User $user, Notification $notification): Response
    {
        return $user->hasPermissionTo('Delete Notification') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this notification');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Notification $notification
     * @return Response
     */
    public function restore(User $user, Notification $notification): Response
        {
            return $user->hasPermissionTo('Restore Notification') ||
            ($user->hasPermissionTo('Restore Notification Owner') && $notification->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this notification');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any notification');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Notification List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
