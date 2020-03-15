<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductCategory;
use App\PurchaseOrder;
use App\UnitOfMeasure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('success_message')) {
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        } elseif (session('error_message')) {
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $products = Product::with('ProductCategory')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $units = UnitOfMeasure::all();
        return view('products.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        PurchaseOrder::query()->create([

            'product_name' => $request->input('product_name'),
            'quantity' => $request->input('quantity'),
            'order_number'=>Str::random(5),
        ]);

        Product::query()->create([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'unit' => $request->input('unit')
        ]);
        return redirect()->route('products')->withSuccessMessage("Product Successfully registered");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return redirect()->route('products')->withErrorMessage("Unsupported function");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return redirect()->route('products')->withErrorMessage("Unsupported function");
    }
    public function view($code)
    {
        return Product::query()->where('product_code' , '=' , $code)->first();
    }


    public function search()
    {
        $search = \request('search');
        return Product::query()->where('quantity' , '>' , 0)->limit(10)->get();
    }
}
