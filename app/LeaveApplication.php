<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class, 'id');
    }
}
