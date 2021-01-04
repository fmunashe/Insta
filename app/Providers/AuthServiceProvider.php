<?php

namespace App\Providers;

use App\Policies\ProductsPolicy;
use App\Policies\PurchaseOrderPolicy;
use App\Policies\RequisitionPolicy;
use App\Product;
use App\PurchaseOrder;
use App\Requisition;
use App\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
       User::class=>UserPolicy::class,
       PurchaseOrder::class=>PurchaseOrderPolicy::class,
       Requisition::class=>RequisitionPolicy::class,
       Product::class=>ProductsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
