<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTakeRequest;
use App\Imports\StockTakesImport;
use App\Product;
use App\StockTake;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class StockTakesController extends Controller
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
        $stocks = StockTake::query()->orderBy('created_at', 'desc')->get();
        return view('stockTake.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny',Product::class);
        return view('stockTake.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockTakeRequest $request)
    {
        $this->authorize('viewAny',Product::class);
        Excel::import(new StockTakesImport, request()->file('import_file'));
        return redirect()->route('stockTakes')->withSuccessMessage("Stock Sheet Successfully Posted");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($stock_count)
    {
        $this->authorize('viewAny',Product::class);
        StockTake::query()->where('stock_count', $stock_count)->delete();
        return redirect()->route('stockTakes')->withSuccessMessage("Stock Count Successfully Rolled Back");
    }
}
