<?php

namespace App\Policies;

use App\Models\Generated\Fee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FeePolicy
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
        return $user->hasPermissionTo('Fee List') ?
            Response::allow() : Response::deny('You don\'t have permission to show fee list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Fee $fee
     * @return Response
     */
    public function view(User $user, Fee $fee): Response
    {
        return $user->hasPermissionTo('Fee List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this fee');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Fee') ?
            Response::allow() : Response::deny('You don\'t have permission to create new fee');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Fee $fee
     * @return Response
     */
    public function update(User $user, Fee $fee): Response
    {
        return $user->hasPermissionTo('Update Fee') ?
            Response::allow() : Response::deny('You don\'t have permission to update this fee');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Fee $fee
     * @return Response
     */
    public function delete(User $user, Fee $fee): Response
    {
        return $user->hasPermissionTo('Delete Fee') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this fee');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Fee $fee
     * @return Response
     */
    public function restore(User $user, Fee $fee): Response
        {
            return $user->hasPermissionTo('Restore Fee') ||
            ($user->hasPermissionTo('Restore Fee Owner') && $fee->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this fee');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any fee');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Fee List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
