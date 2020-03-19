<?php

namespace App\Http\Controllers;

use App\Currency;
use App\ExchangeRate;
use App\Product;
use App\Sale;
use App\SaleLines;
use charlieuki\ReceiptPrinter\ReceiptPrinter;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SaleController extends Controller
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
        $sales = Sale::query()->with('saleLines')->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session('success_message')) {
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        } elseif (session('error_message')) {
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $products = Product::query()->where('quantity', '>', 0)->get();
        $currencies = Currency::query()->with('rate')->get();
        return view('sales.create', compact('products', 'currencies'));
    }

    public function getRate(Request $request)
    {
        $rate = '';
        $id = Currency::query()->where('currency_code', $request->name)->first();
        $code = ExchangeRate::query()->where('currency_code', $id->id)->first();
        $rate .= '<option value="' . $code->rate . '">' . $code->rate . '</option>';
        return response()->json(['rate' => $rate]);
    }

    public function getUnit(Request $request)
    {
        $unit = '';
        $price = '';
        $name = Product::query()->where('product_name', $request->name)->first();
        $unit .= '<option value="' . $name->unit . '">' . $name->unit . '</option>';
        $price .= '<option value="' . $name->price . '">' . $name->price . '</option>';
        return response()->json(['unit' => $unit, 'price' => $price]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Request
     */
    public function store(Request $request)
    {
        $currency = Currency::query()->where('id', $request->rate['currency_code'])->first();
        $sale = Sale::query()->create([
            'amount' => $request->total,
            'currency' => $currency->currency_code,
            'rate' => $request->rate['rate'],
            'sold_by' => auth()->user()->name,
        ]);
        if ($sale) {
            for ($i = 0; $i < count($request->products); $i++) {
                $product = $request->products[$i];
                SaleLines::query()->create([
                    'sale_id' => $sale->id,
                    'item' => $product['product_name'],
                    'quantity' => $product['number'],
                    'price' => $product['price'],
                    'unit' => $product['unit'],
                    'amount' => ($product['number'] * $product['price'])
                ]);
                //decrement product item quantity by the sale quantity
                $getProduct = Product::query()->where('product_name', $product['product_name'])->first();
                Product::query()->where('product_name', $product['product_name'])->update([
                    'quantity' => $getProduct->quantity - $product['number'],
                ]);
            }
            // Set params
            $mid = '123123456';
            $store_name = 'Insta-Visionary Enterprises';
            $store_address = '121 Fife Street Bulawayo';
            $store_phone = '+263783700587/+263772842534';
            $store_email = 'insta@gmail.com';
            $store_website = 'instavisionary.com';
            $tax_percentage = 2;
            $transaction_id = 'TXN-'.$sale->id;
            // Init printer
            $printer = new ReceiptPrinter();
            $printer->init(
                config('receiptprinter.connector_type'),
                config('receiptprinter.connector_descriptor')
            );
            // Set store info
            $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);
            //Add dotted line
            $printer->printDashedLine();
            // Add items
            for ($i = 0; $i < count($request->products); $i++) {
                $product = $request->products[$i];
                $printer->addItem($product['product_name'],$product['number'],$product['price']);
            }
            // Set tax
            $printer->setTax($tax_percentage);
            // Calculate total
            $printer->calculateSubTotal();
            $printer->calculateGrandTotal();
            // Set transaction ID
            $printer->setTransactionID($transaction_id);
            // Set qr code
            $printer->setQRcode([
                'tid' => $transaction_id,
            ]);
            // Print receipt
//            $printer->printReceipt();

            return redirect()->route('createSale')->withSuccessMessage("Sale Successfully recorded");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
