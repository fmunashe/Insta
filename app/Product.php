<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_code', 'product_name', 'product_description', 'price', 'quantity', 'category_id', 'unit', 'product_code'];

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
