<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $guarded=[];

    public function creditors(){
        return $this->belongsToMany(Creditor::class);
    }
}
