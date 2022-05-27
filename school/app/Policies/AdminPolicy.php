<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function viewAny(User $user): Response
    {
        return $user->hasAnyPermission(['Admin List', 'Admin List Owner']) ?
            Response::allow() : Response::deny('You don\'t have permission to show admins list');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function view(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Admin List') ||
        ($user->hasPermissionTo('Admin List Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to show this admin');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Admin') ?
            Response::allow() : Response::deny('You don\'t have permission to create new admin');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function update(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Update Admin') ||
        ($user->hasPermissionTo('Update Admin Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to update this admin');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function delete(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Delete Admin') ||
        ($user->hasPermissionTo('Delete Admin Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to delete this admin');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function restore(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Restore Admin') ||
        ($user->hasPermissionTo('Restore Admin Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to restore this admin');
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any admin');
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function change_status(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Change Admin Status') ||
        ($user->hasPermissionTo('Change Admin Status Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this admin status');
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function change_password(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Change Admin Password') ||
        ($user->hasPermissionTo('Change Admin Password Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this admin password');
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response
     */
    public function change_role(User $user, Admin $admin): Response
    {
        return $user->hasPermissionTo('Change Admin Role') ||
        ($user->hasPermissionTo('Change Admin Role Owner') && $admin->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this admin role');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasAnyPermission(['Create Admin', 'Show Admin Trash Owner']) ? Response::allow() : Response::deny('You don\'t have permission to view trashed admins');
    }
}
