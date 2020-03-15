<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitOfMeasureRequest;
use App\UnitOfMeasure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitOfMeasureController extends Controller
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
        $units=UnitOfMeasure::all();
        return view('measurement.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('measurement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitOfMeasureRequest $request)
    {
        UnitOfMeasure::query()->create([
           'unit_of_measure'=>$request->input('unit_of_measure')
        ]);
        return redirect()->route('units')->withSuccessMessage("New Unit Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(UnitOfMeasure $unitOfMeasure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitOfMeasure $unitOfMeasure)
    {
        return back()->withErrorMessage("Cannot edit unit of measure");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitOfMeasure $unitOfMeasure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitOfMeasure $unitOfMeasure)
    {
        try {
           $unitOfMeasure->delete();
            return redirect()->route('units')->withSuccessMessage("Unit Successfully removed");
        }
        catch(\Exception $ex){
        return back()->withErrorMessage($ex);
        }
    }
}
