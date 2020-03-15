<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SalariesController extends Controller
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
        $grades=Salary::query()->paginate('20');

        return view('grades.index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('grades.create');
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
            'grade'=>'required',
            'amount'=>'required'
        ]);
        Salary::query()->create($data);
        return redirect()->route('salaryGrade')->withSuccessMessage("Salary Grade Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade=Salary::query()->find($id);
        return view('grades.show',compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade=Salary::query()->find($id);
        return view('grades.edit',compact('grade'));
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
            'grade'=>'required',
            'amount'=>'required'
        ]);
        Salary::query()->where('id',$id)->update($data);
        return redirect()->route('salaryGrade')->withSuccessMessage("Salary Grade Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salary::query()->where('id',$id)->delete();
        return redirect()->route('salaryGrade')->withSuccessMessage("Salary Grade Removed");
    }
}
