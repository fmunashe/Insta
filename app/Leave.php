<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
     protected $guarded=[];

     public function applications(){
         return $this->hasMany(LeaveApplication::class,'leave_id');
     }
}
