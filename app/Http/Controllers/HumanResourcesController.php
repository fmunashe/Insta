<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Position;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HumanResourcesController extends Controller
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
        $employees= Employee::query()->paginate(15);

        return view('human_resources.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions= Position::all();

        return view('human_resources.create',compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $this-> validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required','email'],
            'joining_date'=>'required',
            'status'=>'required',
            'mobile_number'=>['required','max:10'],
            'date_of_birth'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'school'=>'required',
            'attained'=>'required',
            'completion_year'=>'required',
            'company'=>'required',
            'position_held'=>'required',
            'position_years'=>'required',
            'position_id'=>'required',
        ]);
        Employee::query()->create($data);
        return redirect()->route('employees')->withSuccessMessage("Employee Created ");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee=Employee::find($id);
        return view('human_resources.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee=Employee::query()->find($id);
        $positions= Position::all();
        return view('human_resources.edit',compact('employee','positions'));
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
        $data= $this-> validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required','email'],
            'joining_date'=>'required',
            'status'=>'required',
            'mobile_number'=>['required','max:10'],
            'date_of_birth'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'school'=>'required',
            'attained'=>'required',
            'completion_year'=>'required',
            'company'=>'required',
            'position_held'=>'required',
            'position_years'=>'required',
            'position_id'=>'required',

        ]);
        Employee::query()->where('id',$id)->update($data);
        Alert::info('Successful', "updated")->persistent('Dismiss');
        return redirect('/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=Employee::find($id);
        $employee->delete();
        Alert::warning('Successful', "employee removed ")->persistent('Dismiss');
        return redirect('/employees');

    }

    public function activate(Employee $employee){

        $employee->update([
                'status'=>1,
            ]
        );
        Alert::info('Successful', "employee $employee->first_name activated ")->persistent('Dismiss');
        return redirect('/employees');

    }
    public function deactivate(Employee $employee)
    {


        $employee->update([
                'status' => 0,
            ]
        );
        Alert::warning('Successful', "employee $employee->first_name deactivated ")->persistent('Dismiss');
        return redirect('/employees');
    }




}
