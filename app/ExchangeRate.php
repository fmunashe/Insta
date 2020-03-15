<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $fillable=['currency_code','rate'];
    public function currency(){
        return $this->belongsTo(Currency::class, 'id');
    }
    public function code($id){
       $id=Currency::query()->where('id',$id)->first();
       return $id->currency_code;
    }
}
