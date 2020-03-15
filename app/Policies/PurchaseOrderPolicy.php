<?php

namespace App\Policies;

use App\User;
use App\PurchaseOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchaseOrderPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any purchase orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
       return $user->admin==true?$this->allow():$this->deny("Not allowed to view purchase orders");
    }

    /**
     * Determine whether the user can view the purchase order.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return mixed
     */
    public function view(User $user, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Determine whether the user can create purchase orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin==true?$this->allow():$this->deny("Not allowed to create or upload orders");
    }

    /**
     * Determine whether the user can update the purchase order.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return mixed
     */
    public function update(User $user, PurchaseOrder $purchaseOrder)
    {
        $user->admin==true?$this->allow():$this->deny("Not allowed to update purchase orders");
    }

    /**
     * Determine whether the user can delete the purchase order.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return mixed
     */
    public function delete(User $user, PurchaseOrder $purchaseOrder)
    {
        $user->admin==true?$this->allow():$this->deny("Not allowed to roll back purchase orders");
    }

    /**
     * Determine whether the user can restore the purchase order.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return mixed
     */
    public function restore(User $user, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the purchase order.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return mixed
     */
    public function forceDelete(User $user, PurchaseOrder $purchaseOrder)
    {
        //
    }
}
