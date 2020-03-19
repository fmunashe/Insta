<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    protected $guarded=[];

    public function requisitions(){
        return  $this->belongsToMany(Requisition::class);
    }
}
