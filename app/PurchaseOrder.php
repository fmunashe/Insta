<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded=[];

    public function suppliers(){
        return $this->belongsToMany(Supplier::class);
    }
}
