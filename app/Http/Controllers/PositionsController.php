<?php

namespace App\Http\Controllers;

use App\Position;
use App\Salary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PositionsController extends Controller
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
        $positions=Position::query()->paginate('20');

        return view('positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades=Salary::all();
        return view('positions.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=$this-> validate($request,[
            'name'=>'required',
            'salary_id'=>'required'
        ]);
        Position::query()->create($data);
        return redirect()->route('employeePositions')->withSuccessMessage("Employee Position Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $positions=Position::query()->find($id);
        return view('positions.show',compact('positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position=Position::query()->find($id);
        $grades=Salary::all();
        return view('positions.edit',compact('position','grades'));
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
        $data=$this-> validate($request,[
            'name'=>'required',
            'salary_id'=>'required'
        ]);
        Position::query()->where('id',$id)->update($data);
        return redirect()->route('employeePositions')->withSuccessMessage("Employee Position Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::query()->where('id',$id)->delete();
        return redirect()->route('employeePositions')->withSuccessMessage("Employee Position Removed");
    }
}
