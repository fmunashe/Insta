<?php

namespace App\Imports;

use App\Product;
use App\StockTake;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockTakesImport implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $checkProduct=Product::query()->where('product_code',$row['product_code'])->value('quantity');
        return new StockTake([
            'product_code' => $row['product_code'],
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'stock_count'=>$row['stock_count'],
            'counted_by'=>$row['counted_by'],
            'variance'=> $checkProduct-$row['quantity'],
        ]);
    }
}
