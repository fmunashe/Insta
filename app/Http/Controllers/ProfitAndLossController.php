<?php

namespace App\Http\Controllers;

use App\Product;
use App\Requisition;
use App\Sale;
use Illuminate\Http\Request;

class ProfitAndLossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $revenue = Sale::query()->sum('amount');
        $sales = Sale::query()->latest()->paginate(10);
        $expenses = Requisition::query()->where('processed', true)->sum('total_amount');
        $losses = Requisition::query()->latest()->where('processed', true)->paginate(10);
        return view('pl.index', compact('revenue', 'sales', 'expenses', 'losses'));
    }

    public function search(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        if ($request->start_date > $request->end_date) {
            return back()->withStatus("Start date cannot be greater than end date");
        } else {
            $revenue = Sale::query()->where('created_at', '>=', $request->input('start_date'))->where('created_at', '<=', $request->input('end_date'))->sum('amount');
            $sales = Sale::query()->latest()->where('created_at', '>=', $request->input('start_date'))->where('created_at', '<=', $request->input('end_date'))->paginate(10);
            $expenses = Requisition::query()->where('processed', true)->where('updated_at', '>=', $request->input('start_date'))->where('updated_at', '<=', $request->input('end_date'))->sum('total_amount');
            $losses = Requisition::query()->latest()->where('processed', true)->where('updated_at', '>=', $request->input('start_date'))->where('updated_at', '<=', $request->input('end_date'))->paginate(10);
            return view('pl.index', compact('revenue', 'sales', 'expenses', 'losses'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
