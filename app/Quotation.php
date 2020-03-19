<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $guarded=[];

    public function customer(){
        return $this->belongsTo(Customer::class,'id');
    }

    public function quotationLines(){
        return $this->hasMany(QuotationLines::class,'quotation_id');
    }
}
