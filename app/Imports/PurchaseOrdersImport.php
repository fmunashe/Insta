<?php

namespace App\Imports;

use App\Product;
use App\PurchaseOrder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchaseOrdersImport implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {

        PurchaseOrder::query()->create([
                'order_number'=>$row['order_number'],
                'product_name' => $row['product_name'],
                'quantity' => $row['quantity'],

            ]
        );
        $checkProduct=Product::query()->where('product_name',$row['product_name'])->first();
        if($checkProduct){
            $checkProduct->quantity+=$row['quantity'];
            $checkProduct->save();
        }
        else {
            return new Product([
                'product_code' => $row['product_code'],
                'product_name' => $row['product_name'],
                'product_description' => $row['product_description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'unit' => $row['unit'],
                'category_id' => $row['category_id'],
            ]);

        }



    }
}
