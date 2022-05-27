<?php

namespace App\Policies;

use App\Models\Generated\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
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
        return $user->hasPermissionTo('Payment List') ?
            Response::allow() : Response::deny('You don\'t have permission to show payment list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Payment $payment
     * @return Response
     */
    public function view(User $user, Payment $payment): Response
    {
        return $user->hasPermissionTo('Payment List') ?
            Response::allow() : Response::deny('You don\'t have permission to show this payment');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Create Payment') ?
            Response::allow() : Response::deny('You don\'t have permission to create new payment');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Payment $payment
     * @return Response
     */
    public function update(User $user, Payment $payment): Response
    {
        return $user->hasPermissionTo('Update Payment') ?
            Response::allow() : Response::deny('You don\'t have permission to update this payment');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Payment $payment
     * @return Response
     */
    public function delete(User $user, Payment $payment): Response
    {
        return $user->hasPermissionTo('Delete Payment') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this payment');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Payment $payment
     * @return Response
     */
    public function restore(User $user, Payment $payment): Response
        {
            return $user->hasPermissionTo('Restore Payment') ||
            ($user->hasPermissionTo('Restore Payment Owner') && $payment->created_by === $user->id) ?
                Response::allow() : Response::deny('You don\'t have permission to restore this payment');
        }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any payment');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function permissions(User $user): Response
    {
        return $user->hasPermissionTo('Payment List') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
