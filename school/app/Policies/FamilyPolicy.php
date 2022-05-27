<?php

namespace App\Policies;

use App\Models\Family;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FamilyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the family can view any models.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function viewAny(User $user): Response
    {
        return $user->hasAnyPermission(['Family List', 'Family List Owner']) ?
            Response::allow() : Response::deny('You don\'t have permission to show familys list');
    }

    /**
     * Determine whether the family can view the model.
     *
     * @param User $user
     * @param Family $family
     * @return Response
     */
    public function view(User $user, Family $family): Response
    {
        return $user->hasPermissionTo('Family List') ||
        ($user->hasPermissionTo('Family List Owner') && $family->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to show this family');
    }

    /**
     * Determine whether the family can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Family') ?
            Response::allow() : Response::deny('You don\'t have permission to create new family');
    }

    /**
     * Determine whether the family can update the model.
     *
     * @param User $user
     * @param Family $family
     * @return Response
     */
    public function update(User $user, Family $family): Response
    {
        return $user->hasPermissionTo('Update Family') ||
        ($user->hasPermissionTo('Update Family Owner') && $family->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to update this family');
    }

    /**
     * Determine whether the family can delete the model.
     *
     * @param User $user
     * @param Family $family
     * @return Response
     */
    public function delete(User $user, Family $family): Response
    {
        return $user->hasPermissionTo('Delete Family') ||
        ($user->hasPermissionTo('Delete Family Owner') && $family->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to delete this family');
    }

    /**
     * Determine whether the family can restore the model.
     *
     * @param User $user
     * @param Family $family
     * @return Response
     */
    public function restore(User $user, Family $family): Response
    {
        return $user->hasPermissionTo('Restore Family') ||
        ($user->hasPermissionTo('Restore Family Owner') && $family->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to restore this family');
    }

    /**
     * Determine whether the family can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any family');
    }

    /**
     * Determine whether the family can permanently delete the model.
     *
     * @param User $user
     * @param Family $family
     * @return Response
     */
    public function change_status(User $user, Family $family): Response
    {
        return $user->hasPermissionTo('Change Family Status') ||
        ($user->hasPermissionTo('Change Family Status Owner') && $family->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this family status');
    }

    /**
     * Determine whether the family can permanently delete the model.
     *
     * @param User $user
     * @param Family $family
     * @return Response
     */
    public function change_password(User $user, Family $family): Response
    {
        return $user->hasPermissionTo('Change Family Password') ||
        ($user->hasPermissionTo('Change Family Password Owner') && $family->created_by === $user->id) ?
            Response::allow() : Response::deny('You don\'t have permission to change this family password');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasAnyPermission(['Create Family', 'Show Family Trash Owner']) ? Response::allow() : Response::deny('You don\'t have permission to view trashed familys');
    }
}
