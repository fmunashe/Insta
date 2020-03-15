<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_code'=>'required',
            'product_name'=>'required|unique:products,product_name',
            'quantity'=>'required|numeric',
            'price'=>'required',
            'product_description'=>'required|min:3',
            'category_id'=>'required',
            'unit'=>'required'
        ];
    }
}
