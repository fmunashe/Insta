<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        elseif(session('error_message')){
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $this->authorize('viewAny',Product::class);
       $suppliers=Supplier::all();
       return view('suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny',Product::class);
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('viewAny',Product::class);
        $data= $this-> validate($request,[
            'name'=>'required|unique:suppliers,name',
            'address'=>'required',
            'phone_number'=>['required','max:10'],
        ]);

        Supplier::query()->create([
            'name'=>$request->input('name'),
            'phone_number'=>$request->input('phone_number'),
            'address'=>$request->input('address'),
            'tax_number'=>$request->input('tax_number'),
            'taxable'=>$request->input('taxable'),
        ]);
        return redirect()->route('suppliers')->withSuccessMessage("Supplier successfully registered");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $this->authorize('viewAny',Product::class);
        try{
        $supplier->delete();
            return redirect()->route('suppliers')->withSuccessMessage("Supplier removed from the system");
        }
        catch (\Exception $ex){
            return redirect()->route('suppliers')->withErrorMessage($ex);
        }
    }
}
