<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded=[];

    public function purchaseOrders(){
        return $this->belongsToMany(PurchaseOrder::class);
    }
}
