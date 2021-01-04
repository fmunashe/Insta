<?php

namespace App\Http\Livewire;

use App\Product;
use App\ProductCategory;
use App\Supplier;
use App\UnitOfMeasure;
use Livewire\Component;

class FilterComponent extends Component
{
    public $product_code='';
    public $product_name='';
    public $product_description='';
    public $price='';
    public $quantity='';
    public function render()
    {
        $categories = ProductCategory::all();
        $units = UnitOfMeasure::all();
        $suppliers= Supplier::all();
        $this->filter();
        return view('livewire.filter-component',compact('units','suppliers','categories'));
    }

    public function filter(){
        if($this->product_code!=null){
            $product=Product::query()->where('product_code','like','%'.$this->product_code.'%')->first();
            if($product){
                $this->product_code=$product->product_code;
                $this->product_name=$product->product_name;
                $this->product_description=$product->product_description;
            }
        }
    }

}
