<?php

namespace App\Policies;

use App\Models\Generated\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
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
        return $user->hasPermissionTo('ClassLevel List') ?
            Response::allow() : Response::deny('You don\'t have permission to show subject list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response
     */
    public function view(User $user, Subject $subject): Response
    {
        return $user->hasPermissionTo('ClassLevel List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this subject');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('ClassLevel Subject') ?
            Response::allow() : Response::deny('You don\'t have permission to create new subject');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response
     */
    public function update(User $user, Subject $subject): Response
    {
        return $user->hasPermissionTo('ClassLevel Subject') ?
            Response::allow() : Response::deny('You don\'t have permission to update this subject');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response
     */
    public function delete(User $user, Subject $subject): Response
    {
        return $user->hasPermissionTo('ClassLevel Subject') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this subject');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response
     */
    public function restore(User $user, Subject $subject): Response
        {
            return $user->hasPermissionTo('ClassLevel Subject') ||
            ($user->hasPermissionTo('Restore Subject Owner') && $subject->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this subject');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any subject');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('ClassLevel List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
