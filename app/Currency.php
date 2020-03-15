<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable=['currency_code','currency_name'];

    public function rate(){
        return $this->hasOne(ExchangeRate::class,'currency_code');
    }
}
