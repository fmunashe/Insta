<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AssetsController extends Controller
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
        $assets=Asset::query()->paginate(10);
        return view('assets.index',compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny',Product::class);
        return view('assets.create');
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
            'asset_number'=>'required',
            'asset_name'=>'required',
            'asset_location'=>'required',
            'asset_classification'=>'required',
            'date_acquired'=>'required',
            'dep_method'=>'required',
            'span'=>'required',
            'dep_rate'=>'required',
            'narration'=>'required',
            'invoice_number'=>'required',
            'invoice_details'=>'required',
            'purchase_price'=>'required',
            'transport_cost'=>'required',
            'other_cost'=>'required',

        ]);

        Asset::query()->create([

            'asset_number' => $request->input('asset_number'),
            'asset_name' => $request->input('asset_name'),
            'asset_location'=>$request->input('asset_location'),
            'asset_classification'=>$request->input('asset_classification'),
            'date_acquired' => $request->input('date_acquired'),
            'dep_method' => $request->input('dep_method'),
            'span'=>$request->input('span'),
            'dep_rate'=>$request->input('dep_rate'),
            'narration' => $request->input('narration'),
            'invoice_number' => $request->input('invoice_number'),
            'invoice_details' => $request->input('invoice_details'),
            'purchase_price'=>$request->input('purchase_price'),
            'transport_cost'=>$request->input('transport_cost'),
            'other_cost' => $request->input('other_cost'),
            'depreciation'=>100,
            'total_cost'=>(($request->input('transport_cost'))+($request->input('transport_cost'))+($request->input('purchase_price'))),

        ]);
        return redirect()->route('assets')->withSuccessMessage("Asset Successfully Added");

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
        return redirect()->route('assets')->withErrorMessage("Unsupported Function");
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
        $this->authorize('viewAny',Product::class);
        $asset=Asset::query()->find($id);
        $asset->delete();
        return redirect()->route('assets')->withSuccessMessage("Asset Successfully Rolled back");
    }
}
