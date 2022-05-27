<?php

namespace App\Policies;

use App\Models\Generated\ClassLevel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClassLevelPolicy
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
            Response::allow() : Response::deny('You don\'t have permission to show class_level list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param ClassLevel $class_level
     * @return Response
     */
    public function view(User $user, ClassLevel $class_level): Response
    {
        return $user->hasPermissionTo('ClassLevel List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this class_level');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create ClassLevel') ?
            Response::allow() : Response::deny('You don\'t have permission to create new class_level');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ClassLevel $class_level
     * @return Response
     */
    public function update(User $user, ClassLevel $class_level): Response
    {
        return $user->hasPermissionTo('Update ClassLevel') ?
            Response::allow() : Response::deny('You don\'t have permission to update this class_level');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ClassLevel $class_level
     * @return Response
     */
    public function delete(User $user, ClassLevel $class_level): Response
    {
        return $user->hasPermissionTo('Delete ClassLevel') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this class_level');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ClassLevel $class_level
     * @return Response
     */
    public function restore(User $user, ClassLevel $class_level): Response
        {
            return $user->hasPermissionTo('Restore ClassLevel') ||
            ($user->hasPermissionTo('Restore ClassLevel Owner') && $class_level->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this class_level');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any class_level');
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
