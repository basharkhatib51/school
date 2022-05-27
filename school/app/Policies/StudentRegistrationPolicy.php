<?php

namespace App\Policies;

use App\Models\Generated\StudentRegistration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StudentRegistrationPolicy
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
        return $user->hasPermissionTo('StudentRegistration List') ?
            Response::allow() : Response::deny('You don\'t have permission to show student_registration list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param StudentRegistration $student_registration
     * @return Response
     */
    public function view(User $user, StudentRegistration $student_registration): Response
    {
        return $user->hasPermissionTo('StudentRegistration List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this student_registration');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create StudentRegistration') ?
            Response::allow() : Response::deny('You don\'t have permission to create new student_registration');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param StudentRegistration $student_registration
     * @return Response
     */
    public function update(User $user, StudentRegistration $student_registration): Response
    {
        return $user->hasPermissionTo('Update StudentRegistration') ?
            Response::allow() : Response::deny('You don\'t have permission to update this student_registration');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param StudentRegistration $student_registration
     * @return Response
     */
    public function delete(User $user, StudentRegistration $student_registration): Response
    {
        return $user->hasPermissionTo('Delete StudentRegistration') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this student_registration');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param StudentRegistration $student_registration
     * @return Response
     */
    public function restore(User $user, StudentRegistration $student_registration): Response
        {
            return $user->hasPermissionTo('Restore StudentRegistration') ||
            ($user->hasPermissionTo('Restore StudentRegistration Owner') && $student_registration->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this student_registration');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any student_registration');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('StudentRegistration List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
