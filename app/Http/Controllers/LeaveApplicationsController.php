<?php

namespace App\Http\Controllers;

use App\Leave;
use App\LeaveApplication;
use App\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveApplicationsController extends Controller
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
        $applications=LeaveApplication::query()->paginate(20);
        return view('apply_leave.index',compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function apply($id){
        $leave=Leave::query()->find($id);
        return view('apply_leave.create',compact('leave'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this-> validate($request,[
            'leave_id'=>'required',
            'days'=>'required'
        ]);
        $check=Leave::query()->where('id',$request['leave_id'])->first();
        if($request['days']>$check->days){
            return redirect()->route('LeaveApplication')->withErrorMessage("Leave application days cannot be more than the allowed ".$check->days." days for the selected ".$check->category." leave type");
        }
        $leave= new LeaveApplication;
        $leave->leave_id =$request->input('leave_id');
        $leave->days =$request->input('days');
        $leave->user_id= auth()->user()->id;
        $leave->save();
        return redirect()->route('LeaveApplication')->withSuccessMessage("Leave Application was Successful");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave=Leave::query()->find($id);
        return view('apply_leave.create',compact('leave'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function acceptLeave(LeaveApplication $application){

        $application->update([
                'status'=>1,
            ]
        );

        return redirect()->route('LeaveApplication')->withSuccessMessage("Leave Application Successfully Authorised");
    }
    public function rejectLeave(LeaveApplication $application)
    {
        $application->update([
                'status' => 2,
            ]
        );
        return redirect()->route('LeaveApplication')->withSuccessMessage("Leave Application Denied");
    }
}
