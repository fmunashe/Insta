<?php

namespace App\Http\Controllers;

use App\Asset;
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
        Alert::info('Successful', "new asset added")->persistent('Dismiss');
        return redirect()->route('assets');

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
        Alert::warning('Unsupported', "please contact admin")->persistent('Dismiss');
        return redirect()->route('assets');
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
        $asset=Asset::query()->find($id);
        $asset->delete();
        return redirect()->route('orders')->withSuccessMessage("Asset Successfully Rolled back");
    }
}
