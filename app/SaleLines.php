<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleLines extends Model
{
    protected $fillable = ['sale_id', 'item', 'amount', 'unit', 'price','quantity'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
