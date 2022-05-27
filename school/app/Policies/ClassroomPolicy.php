<?php

namespace App\Policies;

use App\Models\Generated\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClassroomPolicy
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
        return $user->hasPermissionTo('Classroom List') ?
            Response::allow() : Response::deny('You don\'t have permission to show classroom list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Classroom $classroom
     * @return Response
     */
    public function view(User $user, Classroom $classroom): Response
    {
        return $user->hasPermissionTo('Classroom List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this classroom');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Classroom') ?
            Response::allow() : Response::deny('You don\'t have permission to create new classroom');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Classroom $classroom
     * @return Response
     */
    public function update(User $user, Classroom $classroom): Response
    {
        return $user->hasPermissionTo('Update Classroom') ?
            Response::allow() : Response::deny('You don\'t have permission to update this classroom');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Classroom $classroom
     * @return Response
     */
    public function delete(User $user, Classroom $classroom): Response
    {
        return $user->hasPermissionTo('Delete Classroom') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this classroom');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Classroom $classroom
     * @return Response
     */
    public function restore(User $user, Classroom $classroom): Response
        {
            return $user->hasPermissionTo('Restore Classroom') ||
            ($user->hasPermissionTo('Restore Classroom Owner') && $classroom->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this classroom');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any classroom');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Classroom List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
