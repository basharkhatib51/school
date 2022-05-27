<?php

namespace App\Policies;

use App\Models\Generated\Year;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class YearPolicy
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
        return $user->hasPermissionTo('Year List') ?
            Response::allow() : Response::deny('You don\'t have permission to show year list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Year $year
     * @return Response
     */
    public function view(User $user, Year $year): Response
    {
        return $user->hasPermissionTo('Year List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this year');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Year') ?
            Response::allow() : Response::deny('You don\'t have permission to create new year');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Year $year
     * @return Response
     */
    public function update(User $user, Year $year): Response
    {
        return $user->hasPermissionTo('Update Year') ?
            Response::allow() : Response::deny('You don\'t have permission to update this year');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Year $year
     * @return Response
     */
    public function delete(User $user, Year $year): Response
    {
        return $user->hasPermissionTo('Delete Year') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this year');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Year $year
     * @return Response
     */
    public function restore(User $user, Year $year): Response
        {
            return $user->hasPermissionTo('Restore Year') ||
            ($user->hasPermissionTo('Restore Year Owner') && $year->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this year');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any year');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Year List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
