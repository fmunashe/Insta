<?php

namespace App\Http\Controllers;

use App\Creditor;
use App\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RequisitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions=Requisition::query()->paginate(10);
        return view('requisitions.index',compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $creditors=Creditor::all();
        return view('requisitions.create',compact('creditors'));
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
            'creditor'=>'required',
            'description'=>'required',
            'vatable'=>'required',
            'amount'=>'required',
        ]);

        $requisition=new Requisition();
        $requisition->description = $request->input('description');
        $vat=$requisition->vatable = $request->input('vatable');
        $amt=$requisition->amount = $request->input('amount');
        $requisition->requisition_number=Str::random(5);
        if($vat==1){
            $requisition->total_amount= $amt+$amt*0.10;
            $requisition->vat_amount=$amt*0.10;
        }
        else{
            $requisition->total_amount= $amt;
        }
        $requisition->save();
        $requisition->creditors()->sync($request->creditor);

        Alert::success('Successful', "requisition created ")->persistent('Dismiss');
        return redirect('/requisitions');

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
        $requisition=Requisition::find($id);
        $creditors=Creditor::all();
     return view('requisitions.edit',compact('creditors','requisition'));
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
        $this-> validate($request,[
            'creditor'=>'required',
            'description'=>'required',
            'vatable'=>'required',
            'amount'=>'required',
        ]);

        $requisition=Requisition::find($id);
        $requisition->description = $request->input('description');
        $vat=$requisition->vatable = $request->input('vatable');
        $amt=$requisition->amount = $request->input('amount');
        $requisition->requisition_number= $requisition->requisition_number;
        if($vat==1){
            $requisition->total_amount= $amt+$amt*0.10;
            $requisition->vat_amount=$amt*0.10;
        }
        else{
            $requisition->total_amount= $amt;
        }
        $requisition->save();
        $requisition->creditors()->sync($request->creditor);

        Alert::success('Successful', "requisition updated ")->persistent('Dismiss');
        return redirect('/requisitions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creditor=Requisition::find($id);
        $creditor->creditors()->detach();
        $creditor->delete();
        Alert::warning('Successful', "requisition removed ")->persistent('Dismiss');
        return redirect('/requisitions');
    }
    public function acceptRequisition(Requisition $requisition){

        $requisition->update([
                'status'=>1,
            ]
        );
        Alert::info('Successful', "requisition accepted ")->persistent('Dismiss');
        return redirect('/requisitions');

    }
    public function rejectRequisition(Requisition $requisition)
    {


        $requisition->update([
                'status' => 2,
            ]
        );
        Alert::warning('Successful', "requisition rejected")->persistent('Dismiss');
        return redirect('/requisitions');
    }

    public function acceptPayment(Requisition $payment){
        if($payment->status==1){
            $payment->update([
                    'processed'=>1,
                ]
            );
            Alert::info('Successful', "payment processed")->persistent('Dismiss');

            return redirect()->route('requisitions');

        }
        else{
            Alert::warning('Successful', "payment not authorised")->persistent('Dismiss');

            return redirect()->route('requisitions');
        }

    }
    public function rejectPayment(Requisition $payment)
    {
        $payment->update([
                'processed' => 0,
            ]
        );
        Alert::warning('Successful', "payment not processed")->persistent('Dismiss');
        return redirect()->route('requisitions');
    }
}
