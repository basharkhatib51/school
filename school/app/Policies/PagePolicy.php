<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagePolicy
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
        return $user->hasPermissionTo('Page List') ?
            Response::allow() : Response::deny('You don\'t have permission to show page list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function view(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Page List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this page');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Page') ?
            Response::allow() : Response::deny('You don\'t have permission to create new page');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function update(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Update Page') ?
            Response::allow() : Response::deny('You don\'t have permission to update this page');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function delete(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Delete Page') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this page');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function restore(User $user, Page $page): Response
        {
            return $user->hasPermissionTo('Restore Page') ||
            ($user->hasPermissionTo('Restore Page Owner') && $page->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this page');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any page');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Page List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
