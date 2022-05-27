<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SettingPolicy
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
        return $user->hasPermissionTo('Setting List') ?
            Response::allow() : Response::deny('You don\'t have permission to show setting list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Setting $setting
     * @return Response
     */
    public function view(User $user, Setting $setting): Response
    {
        return $user->hasPermissionTo('Setting List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this setting');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Setting') ?
            Response::allow() : Response::deny('You don\'t have permission to create new setting');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Setting $setting
     * @return Response
     */
    public function update(User $user, Setting $setting): Response
    {
        return $user->hasPermissionTo('Update Setting') ?
            Response::allow() : Response::deny('You don\'t have permission to update this setting');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Setting $setting
     * @return Response
     */
    public function delete(User $user, Setting $setting): Response
    {
        return $user->hasPermissionTo('Delete Setting') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this setting');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Setting $setting
     * @return Response
     */
    public function restore(User $user, Setting $setting): Response
        {
            return $user->hasPermissionTo('Restore Setting') ||
            ($user->hasPermissionTo('Restore Setting Owner') && $setting->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this setting');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any setting');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Setting List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
