<?php

namespace App\Policies;

use App\Models\Generated\Program;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProgramPolicy
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
        return $user->hasPermissionTo('Program List') ?
            Response::allow() : Response::deny('You don\'t have permission to show program list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Program $program
     * @return Response
     */
    public function view(User $user, Program $program): Response
    {
        return $user->hasPermissionTo('Program List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this program');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Program') ?
            Response::allow() : Response::deny('You don\'t have permission to create new program');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Program $program
     * @return Response
     */
    public function update(User $user, Program $program): Response
    {
        return $user->hasPermissionTo('Update Program') ?
            Response::allow() : Response::deny('You don\'t have permission to update this program');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Program $program
     * @return Response
     */
    public function delete(User $user, Program $program): Response
    {
        return $user->hasPermissionTo('Delete Program') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this program');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Program $program
     * @return Response
     */
    public function restore(User $user, Program $program): Response
        {
            return $user->hasPermissionTo('Restore Program') ||
            ($user->hasPermissionTo('Restore Program Owner') && $program->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this program');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any program');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Program List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}