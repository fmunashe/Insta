<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Invoice;
use App\Quotation;
use App\QuotationLines;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class QuotationController extends Controller
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
        $quotations = Quotation::all();
        return view('quotation.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::with('rate')->get();
        return view('quotation.createQuotation', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ]);
        $quotation = new Quotation();
        $latestQuotation = Quotation::query()->orderby('created_at', 'DESC')->first();
        if ($latestQuotation == null) {
            $quotation->quotation_number = 'QT' . str_pad(1, 7, "0", STR_PAD_LEFT);
        } else {
            $quotation->quotation_number = 'QT' . str_pad($latestQuotation->id + 1, 7, "0", STR_PAD_LEFT);
        }
        $quotation->customer_id = $customer->id;
        $quotation->quotation_description = $request->input('Description');
        $quotation->quotation_amount = $request->input('Amount');
        $quotation->currency = $request->input('currency');
        $quotation->rate = $request->input('rate');
        $quotation->save();

        for ($i = 0; $i < count($request->input('ItemDescription')); $i++) {
            QuotationLines::query()->create([
                'quotation_id' => $quotation->id,
                'item_description' => $request->ItemDescription[$i],
                'price' => $request->ItemPrice[$i],
                'quantity' => $request->ItemQuantity[$i],
                'line_total' => $request->ItemPrice[$i] * $request->ItemQuantity[$i]
            ]);
        }
        $QuotationDetails = Quotation::query()->where('id', $quotation->id)->with('quotationLines')->first();
        return view('quotation.show', compact('QuotationDetails', 'customer'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($quotation)
    {
        $QuotationDetails = Quotation::query()->where('id', $quotation)->with('quotationLines')->first();
        $customer = Customer::query()->where('id', $QuotationDetails->customer_id)->first();
        return view('quotation.show', compact('QuotationDetails', 'customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
