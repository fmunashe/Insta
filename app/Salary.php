<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $guarded=[];
    public function position(){
        return $this->hasMany(Position::class);
    }
}
