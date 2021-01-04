<?php

namespace App\Http\Controllers;

use App\Currency;
use App\ExchangeRate;
use App\Product;
use App\Sale;
use App\SaleLines;
use http\Env\Response;
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
        $this->authorize('viewAny',Product::class);
        $sales=Sale::query()->with('saleLines')->get();
        return view('sales.index',compact('sales'));
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
        $tot=0;
        for ($i = 0; $i < count($request->ItemDescription); $i++) {
            $product = Product::query()->where('product_code',$request->ItemDescription[$i])->first();
            if($request->ItemQuantity[$i]>$product->quantity){
                return redirect()->route('createSale')->withStatus("Quantity of ".$request->ItemQuantity[$i]." for item ".$product->product_name." is greater than remaining quantity in stock of ".$product->quantity);
            }
            else{
                $tot =$tot+ ($product->price * $request->ItemQuantity[$i]);
            }
        }
        $sale = Sale::query()->create([
            'amount' => $tot*$request->input('rate'),
            'currency' => $request->input('currency'),
            'rate' => $request->input('rate'),
            'sold_by' => auth()->user()->name,
        ]);
        if ($sale) {
            for ($i = 0; $i < count($request->ItemDescription); $i++) {
                $product = Product::query()->where('product_code',$request->ItemDescription[$i])->first();
                SaleLines::query()->create([
                    'sale_id' => $sale->id,
                    'item' => $product->product_name,
                    'quantity' => $request->ItemQuantity[$i],
                    'price' => $product->price,
                    'unit' => $product->unit,
                    'amount' => ($product->price * $request->ItemQuantity[$i])
                ]);
                //decrement product item quantity by the sale quantity
                $quant=$product->quantity;
                $product->update([
                'quantity'=>$quant-$request->ItemQuantity[$i]
                ]);
            }
            $SaleDetails = Sale::query()->where('id', $sale->id)->with('saleLines')->first();
            $lineTotal=SaleLines::query()->where('sale_id',$sale->id)->sum('amount');
            return view('sales.show', compact('SaleDetails', 'lineTotal'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($receipt)
    {
        $SaleDetails = Sale::query()->where('id', $receipt)->with('saleLines')->first();
        $lineTotal=SaleLines::query()->where('sale_id',$receipt)->sum('amount');
        return view('sales.show', compact('SaleDetails','lineTotal'));
    }


    public function mySales(){
        $sales=Sale::query()->where('sold_by',auth()->user()->name)->with('saleLines')->get();
        return view('sales.individualSales',compact('sales'));
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
