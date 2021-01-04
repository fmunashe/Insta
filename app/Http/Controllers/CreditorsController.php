<?php

namespace App\Http\Controllers;

use App\Creditor;
use App\Product;
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
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        elseif(session('error_message')){
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $this->authorize('viewAny',Product::class);
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
        $this->authorize('viewAny',Product::class);
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
        $this->authorize('viewAny',Product::class);
        $data= $this-> validate($request,[
            'name'=>'required|unique:creditors,name',
            'address'=>'required',
            'phone_number'=>['required','max:10'],

        ]);

        Creditor::query()->create($data);
        return redirect()->route('creditors')->withSuccessMessage("Creditor successfully registered");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('viewAny',Product::class);
        $creditors=Creditor::query()->find($id);
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
        $this->authorize('viewAny',Product::class);
        $creditor=Creditor::query()->find($id);
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
        $this->authorize('viewAny',Product::class);
        $data= $this-> validate($request,[
            'name'=>'required',
            'address'=>'required',
            'phone_number'=>['required','max:10'],

        ]);
        Creditor::query()->where('id',$id)->update($data);
        return redirect()->route('creditors')->withSuccessMessage("Creditor Information Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('viewAny',Product::class);
        try {
            Creditor::query()->find($id)->delete();
            return redirect()->route('creditors')->withSuccessMessage("Creditor Successfully Removed from the system");
        }
        catch(\Exception $ex){
            return redirect()->route('creditors')->withErrorMessage($ex);
        }
    }
}
