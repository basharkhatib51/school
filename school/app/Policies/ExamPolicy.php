<?php

namespace App\Policies;

use App\Models\Generated\Exam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExamPolicy
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
        return $user->hasPermissionTo('Exam List') ?
            Response::allow() : Response::deny('You don\'t have permission to show exam list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Exam $exam
     * @return Response
     */
    public function view(User $user, Exam $exam): Response
    {
        return $user->hasPermissionTo('Exam List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this exam');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Exam') ?
            Response::allow() : Response::deny('You don\'t have permission to create new exam');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Exam $exam
     * @return Response
     */
    public function update(User $user, Exam $exam): Response
    {
        return $user->hasPermissionTo('Update Exam') ?
            Response::allow() : Response::deny('You don\'t have permission to update this exam');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Exam $exam
     * @return Response
     */
    public function delete(User $user, Exam $exam): Response
    {
        return $user->hasPermissionTo('Delete Exam') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this exam');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Exam $exam
     * @return Response
     */
    public function restore(User $user, Exam $exam): Response
        {
            return $user->hasPermissionTo('Restore Exam') ||
            ($user->hasPermissionTo('Restore Exam Owner') && $exam->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this exam');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any exam');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Exam List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
