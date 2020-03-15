<?php

namespace App\Http\Controllers;

use App\Currency;
use App\ExchangeRate;
use App\Http\Requests\ExchangeRateRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ExchangeRateController extends Controller
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

        $rates=ExchangeRate::with('currency')->get();
        return view('rates.index',compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies=Currency::all();
        return view('rates.create',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExchangeRateRequest $request)
    {
        ExchangeRate::query()->create([
            'currency_code'=>$request->input('currency_code'),
            'rate'=>$request->input('rate')
        ]);
        return redirect()->route('rates')->withSuccessMessage("New Rate successfully set");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ExchangeRate $exchangeRate)
    {
        return view('rates.edit',compact('exchangeRate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExchangeRate $exchangeRate)
    {
        $exchangeRate->update([
          'rate'=>$request->input('rate')
        ]);
        return redirect()->route('rates')->withSuccessMessage("Rates for currency ".$request->input('currency_code')." successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeRate $exchangeRate)
    {
        try{
            $exchangeRate->delete();
            return redirect()->route('rates')->withSuccessMessage("Rate Successfully removed from the system");
        }
        catch(\Exception $ex){
            return back()->withErrorMessage($ex);
        }
    }
}
