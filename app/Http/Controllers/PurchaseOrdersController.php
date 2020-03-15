<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderRequest;
use App\Imports\PurchaseOrdersImport;
use App\Product;
use App\PurchaseOrder;
use App\User;
use Illuminate\Http\Request;
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
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseOrderRequest $request)
    {
        Excel::import(new PurchaseOrdersImport, request()->file('import_file'));
       return redirect()->route('orders')->withSuccessMessage("Products Successfully Uploaded");
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
        $product=PurchaseOrder::query()->find($id);
        return view('orders.edit',compact('product'));
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
    public function destroy(PurchaseOrder $order,$id)
    {
        $this->authorize('delete',$order);
        $purchaseOrder=PurchaseOrder::query()->find($id);
        $name=PurchaseOrder::query()->where('id',$id)->value('product_name');
        $quantity=PurchaseOrder::query()->where('id',$id)->value('quantity');
        $product=Product::query()->where('product_name',$name);
        $productQuantity=Product::query()->where('product_name',$name)->value('quantity');
        $product->update([
            'quantity'=>$productQuantity-$quantity
        ]);
        $purchaseOrder->delete();
        return redirect()->route('orders')->withSuccessMessage("Product Successfully Rolled back");
    }
}
