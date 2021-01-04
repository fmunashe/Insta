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
        if (session('success_message')) {
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        } elseif (session('error_message')) {
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $requisitions = Requisition::query()->latest()->paginate(10);
        return view('requisitions.index', compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $creditors = Creditor::all();
        return view('requisitions.create', compact('creditors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'creditor' => 'required',
            'description' => 'required',
            'vatable' => 'required',
            'amount' => 'required',
        ]);

        $requisition = new Requisition();
        $latestRequisition = Requisition::query()->orderby('created_at', 'DESC')->first();
        if ($latestRequisition == null) {
            $requisition->requisition_number = 'RQ' . str_pad(1, 7, "0", STR_PAD_LEFT);
        } else {
            $requisition->requisition_number = 'RQ' . str_pad($latestRequisition->id + 1, 7, "0", STR_PAD_LEFT);
        }
        $requisition->description = $request->input('description');
        $vat = $requisition->vatable = $request->input('vatable');
        $amt = $requisition->amount = $request->input('amount');
        if ($vat == 1) {
            $requisition->total_amount = $amt + $amt * 0.10;
            $requisition->vat_amount = $amt * 0.10;
        } else {
            $requisition->total_amount = $amt;
        }
        $requisition->save();
        $requisition->creditors()->sync($request->creditor);

        return redirect()->route('requisitions')->withSuccessMessage("Requisition Successfully Raised");

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
        $requisition = Requisition::query()->find($id);
        if ($requisition->status != 0) {
            return redirect()->route('requisitions')->withErrorMessage("You cannot modify an authorised requisition");
        }
        else {

            $creditors = Creditor::all();
            return view('requisitions.edit', compact('creditors', 'requisition'));
        }
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
        $this->validate($request, [
            'creditor' => 'required',
            'description' => 'required',
            'vatable' => 'required',
            'amount' => 'required',
        ]);

        $requisition = Requisition::query()->find($id);
        $requisition->description = $request->input('description');
        $vat = $requisition->vatable = $request->input('vatable');
        $amt = $requisition->amount = $request->input('amount');
        $requisition->requisition_number = $requisition->requisition_number;
        if ($vat == 1) {
            $requisition->total_amount = $amt + $amt * 0.10;
            $requisition->vat_amount = $amt * 0.10;
        } else {
            $requisition->total_amount = $amt;
        }
        $requisition->save();
        $requisition->creditors()->sync($request->creditor);

        return redirect()->route('requisitions')->withSuccessMessage("Requisition successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $creditor = Requisition::query()->find($id);
            if ($creditor->status != 0) {
                return redirect()->route('requisitions')->withErrorMessage("You cannot roll back an authorised requisition");
            } else {
                $creditor->creditors()->detach();
                $creditor->delete();
                return redirect()->route('requisitions')->withSuccessMessage("Requisition rolled back successfully");
            }
        } catch (\Exception $ex) {
            return redirect()->route('requisitions')->withErrorMessage($ex);
        }
    }

    public function acceptRequisition(Requisition $requisition)
    {
        $this->authorize('update',$requisition);
        if ($requisition->status == 0) {
            $requisition->update([
                    'status' => 1,
                ]
            );
            return redirect()->route('requisitions')->withSuccessMessage("Requisition Successfully Approved");
        } else {
            return redirect()->route('requisitions')->withErrorMessage("Requisition was previously authorised /declined");
        }
    }

    public function rejectRequisition(Requisition $requisition)
    {
        $this->authorize('update',$requisition);
        if($requisition->status==0){
            $requisition->update([
                    'status' => 2,
                ]
            );
            return redirect()->route('requisitions')->withSuccessMessage("Requisition Declined");
        }
        return redirect()->route('requisitions')->withErrorMessage("Requisition was previously authorised / declined");
    }

    public function acceptPayment(Requisition $payment)
    {
        $this->authorize('create',$payment);
        if ($payment->status == 1 and $payment->processed==0) {
            $payment->update([
                    'processed' => 1,
                ]
            );
            return redirect()->route('requisitions')->withSuccessMessage("Payment Processed");
        }
        elseif ($payment->status==1 and $payment->processed==1){
            return redirect()->route('requisitions')->withErrorMessage("Payment was previously effected");
        }
        elseif ($payment->status==2){
            return redirect()->route('requisitions')->withErrorMessage("You cannot pay a rejected requisition");
        }
        else {
            return redirect()->route('requisitions')->withErrorMessage("Requisition must be authorised first");
        }
    }

    public function rejectPayment(Requisition $payment)
    {
        $payment->update([
                'processed' => 0,
            ]
        );
        return redirect()->route('requisitions')->withSuccessMessage("Payment not processed");
    }
}
