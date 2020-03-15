<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['amount', 'sold_by','currency','rate'];

    public function saleLines()
    {
        return $this->hasMany(SaleLines::class, 'sale_id');
    }
}
