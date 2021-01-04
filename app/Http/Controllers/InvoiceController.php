<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Invoice;
use App\InvoiceLines;
use App\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
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
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::with('rate')->get();
        $products=Product::all();
        return view('invoices.createInvoice', compact('currencies','products'));
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
        $invoice = new Invoice();
        $latestInvoice = Invoice::query()->orderby('created_at', 'DESC')->first();
        if ($latestInvoice == null) {
            $invoice->invoice_number = 'INV' . str_pad(1, 7, "0", STR_PAD_LEFT);
        } else {
            $invoice->invoice_number = 'INV' . str_pad($latestInvoice->id + 1, 7, "0", STR_PAD_LEFT);
        }
        $invoice->customer_id = $customer->id;
        $invoice->invoice_description = $request->input('Description');
        $invoice->invoice_amount = $request->input('Amount');
        $invoice->currency = $request->input('currency');
        $invoice->rate = $request->input('rate');
        $invoice->save();

        for ($i = 0; $i < count($request->input('ItemDescription')); $i++) {
            InvoiceLines::query()->create([
                'invoice_id' => $invoice->id,
                'item_description' => $request->ItemDescription[$i],
                'price' => $request->ItemPrice[$i],
                'quantity' => $request->ItemQuantity[$i],
                'line_total' => $request->ItemPrice[$i] * $request->ItemQuantity[$i]
            ]);
        }
        $InvoiceDetails = Invoice::query()->where('id', $invoice->id)->with('invoiceLines')->first();
        $lineTotal=InvoiceLines::query()->where('invoice_id',$invoice->id)->sum('line_total');
        return view('invoices.show', compact('InvoiceDetails', 'customer','lineTotal'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        $InvoiceDetails = Invoice::query()->where('id', $invoice)->with('invoiceLines')->first();
        $customer = Customer::query()->where('id', $InvoiceDetails->customer_id)->first();
        $lineTotal=InvoiceLines::query()->where('invoice_id',$invoice)->sum('line_total');
        return view('invoices.show', compact('InvoiceDetails', 'customer','lineTotal'));
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
