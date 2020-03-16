<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationLines extends Model
{
    protected $guarded=[];
    public function quotation(){
        return $this->belongsTo(Quotation::class,'id');
    }
}
