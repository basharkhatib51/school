<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the student can view any models.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function viewAny(User $user): Response
    {
        return $user->hasAnyPermission(['Student List', 'Student List Owner']) ?
            Response::allow() : Response::deny('You don\'t have permission to show students list');
    }

    /**
     * Determine whether the student can view the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response
     */
    public function view(User $user, Student $student): Response
    {
        return $user->hasPermissionTo('Student List') ||
        ($user->hasPermissionTo('Student List Owner') && $student->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to show this student');
    }

    /**
     * Determine whether the student can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Student') ?
            Response::allow() : Response::deny('You don\'t have permission to create new student');
    }

    /**
     * Determine whether the student can update the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response
     */
    public function update(User $user, Student $student): Response
    {
        return $user->hasPermissionTo('Update Student') ||
        ($user->hasPermissionTo('Update Student Owner') && $student->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to update this student');
    }

    /**
     * Determine whether the student can delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response
     */
    public function delete(User $user, Student $student): Response
    {
        return $user->hasPermissionTo('Delete Student') ||
        ($user->hasPermissionTo('Delete Student Owner') && $student->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to delete this student');
    }

    /**
     * Determine whether the student can restore the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response
     */
    public function restore(User $user, Student $student): Response
    {
        return $user->hasPermissionTo('Restore Student') ||
        ($user->hasPermissionTo('Restore Student Owner') && $student->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to restore this student');
    }

    /**
     * Determine whether the student can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any student');
    }

    /**
     * Determine whether the student can permanently delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response
     */
    public function change_status(User $user, Student $student): Response
    {
        return $user->hasPermissionTo('Change Student Status') ||
        ($user->hasPermissionTo('Change Student Status Owner') && $student->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this student status');
    }

    /**
     * Determine whether the student can permanently delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response
     */
    public function change_password(User $user, Student $student): Response
    {
        return $user->hasPermissionTo('Change Student Password') ||
        ($user->hasPermissionTo('Change Student Password Owner') && $student->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this student password');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasAnyPermission(['Create Student', 'Show Student Trash Owner']) ? Response::allow() : Response::deny('You don\'t have permission to view trashed students');
    }
}
