<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded=[];

    public function customer(){
        return $this->belongsTo(Customer::class,'id');
    }

    public function invoiceLines(){
        return $this->hasMany(InvoiceLines::class,'invoice_id');
    }
}
