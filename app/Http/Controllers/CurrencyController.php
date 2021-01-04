<?php

namespace App\Http\Controllers;

use App\Currency;
use App\ExchangeRate;
use App\Http\Requests\CurrencyRequest;
use App\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CurrencyController extends Controller
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
        $currencies=Currency::with('rate')->get();
        return view('currency.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny',Product::class);
        return view('currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $this->authorize('viewAny',Product::class);
        Currency::query()->create([
          'currency_code'=>$request->input('currency_code') ,
          'currency_name'=>$request->input('currency_name')
        ]);
        return redirect()->route('currencies')->withSuccessMessage("Currency successfully registered");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return back()->withErrorMessage("Function not supported");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $this->authorize('viewAny',Product::class);
        try{
           $currency->delete();
           return redirect()->route('currencies')->withSuccessMessage("Currency removed successfully from the system");
        }
        catch(\Exception $ex){
           return back()->withErrorMessage($ex);
        }
    }

    public function searchCurrency($currency){
    $currencyId=Currency::query()->where('currency_code',$currency)->first();
    $rate=ExchangeRate::query()->where('currency_code',$currencyId->id)->first();
    return response()->json(["rate"=>$rate->rate]);
    }
}
