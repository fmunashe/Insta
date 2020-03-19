<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderRequest;
use App\Imports\PurchaseOrdersImport;
use App\Product;
use App\ProductCategory;
use App\PurchaseOrder;
use App\Supplier;
use App\UnitOfMeasure;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        elseif(session('error_message')){
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $orders=PurchaseOrder::query()->paginate(20);
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param PurchaseOrder $order
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(PurchaseOrder $order)
    {
        $this->authorize('create',$order);
        $categories = ProductCategory::all();
        $units = UnitOfMeasure::all();
        $suppliers= Supplier::all();
        return view('orders.create', compact('categories', 'units','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $this-> validate($request,[
            'product_code'=>'required',
            'quantity'=>'required',
            'invoice'=>'required',
            'supplier_id'=>'required',
            'product_name'=>'required',
            'unit'=>'required',
            'cost_price'=>'required',
            'product_description'=>'required',
            'price'=>'required','max:10',
            'category_id'=>'required',

        ]);

        $orders=PurchaseOrder::query()->create([

            'product_name' => $request->input('product_name'),
            'quantity' => $request->input('quantity'),
            'invoice'=>$request->input('invoice'),
            'cost_price'=>$request->input('cost_price'),
            'order_number'=>Str::random(5),
        ]);
        $orders->suppliers()->sync($request->supplier_id);

        $checkProduct=Product::query()->where('product_name',$request->input('product_name'))->orWhere('product_code',$request->input('product_code'))->first();
        if($checkProduct){
            $checkProduct->quantity+= $request->input('quantity');
            $checkProduct->save();
        }
        else{
            Product::query()->create([
                'product_code' => $request->input('product_code'),
                'product_name' => $request->input('product_name'),
                'product_description' => $request->input('product_description'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id'),
                'unit' => $request->input('unit')
            ]);
        }
        Alert::info('Successful', "new stock added")->persistent('Dismiss');
        return redirect()->route('orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Alert::warning('Successful', "Unsupported function, to edit price go to products")->persistent('Dismiss');
        return view('orders.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $this->authorize('delete',$order);
        $purchaseOrder=PurchaseOrder::query()->find($id);
        $name=PurchaseOrder::query()->where('id',$id)->value('product_name');
        $quantity=PurchaseOrder::query()->where('id',$id)->value('quantity');
        $product=Product::query()->where('product_name',$name);
        $productQuantity=Product::query()->where('product_name',$name)->value('quantity');
        $product->update([
            'quantity'=>$productQuantity-$quantity
        ]);
        $purchaseOrder->suppliers()->detach();
        $purchaseOrder->delete();
        return redirect()->route('orders')->withSuccessMessage("Product Successfully Rolled back");
    }
}
