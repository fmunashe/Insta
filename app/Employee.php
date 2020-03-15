<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded=[];
    public function position(){
        return $this-> belongsTo(Position::class);
    }

    public function payRolls(){
        return $this->hasMany(PayRoll::class);
    }
}
