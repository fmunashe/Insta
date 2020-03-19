<?php

namespace App\Http\Controllers;

use App\Creditor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CreditorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditors=Creditor::query()->paginate(10);
        return view('creditors.index',compact("creditors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('creditors.create');
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
            'name'=>'required',
            'address'=>'required',
            'phone_number'=>['required','max:10'],

        ]);

        Creditor::query()->create($data);
        Alert::info('Successful', "a creditor created")->persistent('Dismiss');
        return redirect()->route('creditors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditors=Creditor::find($id);
        return view('creditors.show',compact('creditors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $creditor=Creditor::find($id);
        return view('creditors.edit',compact('creditor'));
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
            'name'=>'required',
            'address'=>'required',
            'phone_number'=>['required','max:10'],

        ]);
        Creditor::query()->where('id',$id)->update($data);
        Alert::info('Successful', "creditor info updated")->persistent('Dismiss');
        return redirect('/creditors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Alert::warning('Successful', "creditor can not be deleted")->persistent('Dismiss');
        return redirect('/creditors');
    }
}
