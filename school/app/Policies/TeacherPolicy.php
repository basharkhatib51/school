<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the teacher can view any models.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function viewAny(User $user): Response
    {
        return $user->hasAnyPermission(['Teacher List', 'Teacher List Owner']) ?
            Response::allow() : Response::deny('You don\'t have permission to show teachers list');
    }

    /**
     * Determine whether the teacher can view the model.
     *
     * @param User $user
     * @param Teacher $teacher
     * @return Response
     */
    public function view(User $user, Teacher $teacher): Response
    {
        return $user->hasPermissionTo('Teacher List') ||
        ($user->hasPermissionTo('Teacher List Owner') && $teacher->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to show this teacher');
    }

    /**
     * Determine whether the teacher can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Teacher') ?
            Response::allow() : Response::deny('You don\'t have permission to create new teacher');
    }

    /**
     * Determine whether the teacher can update the model.
     *
     * @param User $user
     * @param Teacher $teacher
     * @return Response
     */
    public function update(User $user, Teacher $teacher): Response
    {
        return $user->hasPermissionTo('Update Teacher') ||
        ($user->hasPermissionTo('Update Teacher Owner') && $teacher->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to update this teacher');
    }

    /**
     * Determine whether the teacher can delete the model.
     *
     * @param User $user
     * @param Teacher $teacher
     * @return Response
     */
    public function delete(User $user, Teacher $teacher): Response
    {
        return $user->hasPermissionTo('Delete Teacher') ||
        ($user->hasPermissionTo('Delete Teacher Owner') && $teacher->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to delete this teacher');
    }

    /**
     * Determine whether the teacher can restore the model.
     *
     * @param User $user
     * @param Teacher $teacher
     * @return Response
     */
    public function restore(User $user, Teacher $teacher): Response
    {
        return $user->hasPermissionTo('Restore Teacher') ||
        ($user->hasPermissionTo('Restore Teacher Owner') && $teacher->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to restore this teacher');
    }

    /**
     * Determine whether the teacher can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any teacher');
    }

    /**
     * Determine whether the teacher can permanently delete the model.
     *
     * @param User $user
     * @param Teacher $teacher
     * @return Response
     */
    public function change_status(User $user, Teacher $teacher): Response
    {
        return $user->hasPermissionTo('Change Teacher Status') ||
        ($user->hasPermissionTo('Change Teacher Status Owner') && $teacher->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this teacher status');
    }

    /**
     * Determine whether the teacher can permanently delete the model.
     *
     * @param User $user
     * @param Teacher $teacher
     * @return Response
     */
    public function change_password(User $user, Teacher $teacher): Response
    {
        return $user->hasPermissionTo('Change Teacher Password') ||
        ($user->hasPermissionTo('Change Teacher Password Owner') && $teacher->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this teacher password');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasAnyPermission(['Create Teacher', 'Show Teacher Trash Owner']) ? Response::allow() : Response::deny('You don\'t have permission to view trashed teachers');
    }
}
