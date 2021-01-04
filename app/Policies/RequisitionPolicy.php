<?php

namespace App\Policies;

use App\User;
use App\Requisition;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequisitionPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any requisitions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->admin==true?$this->allow():$this->deny("You are not allowed to modify requisition details");
    }

    /**
     * Determine whether the user can view the requisition.
     *
     * @param  \App\User  $user
     * @param  \App\Requisition  $requisition
     * @return mixed
     */
    public function view(User $user, Requisition $requisition)
    {
        //
    }

    /**
     * Determine whether the user can create requisitions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->cashier==true?$this->allow():$this->deny("Only the cashier is allowed to process requisition payments");
    }

    /**
     * Determine whether the user can update the requisition.
     *
     * @param  \App\User  $user
     * @param  \App\Requisition  $requisition
     * @return mixed
     */
    public function update(User $user, Requisition $requisition)
    {
        return $user->admin==true?$this->allow():$this->deny("You are not allowed to modify requisition details");
    }

    /**
     * Determine whether the user can delete the requisition.
     *
     * @param  \App\User  $user
     * @param  \App\Requisition  $requisition
     * @return mixed
     */
    public function delete(User $user, Requisition $requisition)
    {
        //
    }

    /**
     * Determine whether the user can restore the requisition.
     *
     * @param  \App\User  $user
     * @param  \App\Requisition  $requisition
     * @return mixed
     */
    public function restore(User $user, Requisition $requisition)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the requisition.
     *
     * @param  \App\User  $user
     * @param  \App\Requisition  $requisition
     * @return mixed
     */
    public function forceDelete(User $user, Requisition $requisition)
    {
        //
    }
}
