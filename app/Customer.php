<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded=[];

    public function invoices(){
        return $this->hasMany(Invoice::class,'customer_id');
    }
    public function quotations(){
        return $this->hasMany(Quotation::class,'customer_id');
    }
}
