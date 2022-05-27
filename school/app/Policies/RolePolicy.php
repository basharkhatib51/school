<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RolePolicy
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
        return $user->hasPermissionTo('Role List') ?
            Response::allow() : Response::deny('You don\'t have permission to show roles list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Role $role
     * @return Response
     */
    public function view(User $user, Role $role): Response
    {
        return $user->hasPermissionTo('Role List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this role');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Role') ?
            Response::allow() : Response::deny('You don\'t have permission to create new role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Role $role
     * @return Response
     */
    public function update(User $user, Role $role): Response
    {
        return $user->hasPermissionTo('Update Role') ?
            Response::allow() : Response::deny('You don\'t have permission to update this role');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Role $role
     * @return Response
     */
    public function delete(User $user, Role $role): Response
    {
        return $user->hasPermissionTo('Delete Role') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this role');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Role $role
     * @return Response
     */
    public function restore(User $user, Role $role): Response
    {
        return $user->hasPermissionTo('Delete Role') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this role');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any role');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Role List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
