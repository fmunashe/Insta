<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseOrder;
use App\Requisition;
use App\Revenue;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrialBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $date = Carbon::now();
        $sales = Sale::query()->sum('amount');
        $rent = Requisition::query()->where('description', "Rent")->where('processed', true)->sum('total_amount');
        $stationery = Requisition::query()->where('description', "Stationery")->where('processed', true)->sum('total_amount');
        $telephone = Requisition::query()->where('description', "Telephone")->where('processed', true)->sum('total_amount');
        $consultation = Requisition::query()->where('description', "Consultation")->where('processed', true)->sum('total_amount');
        $salaries = Requisition::query()->where('description', "Salaries and Wages")->where('processed', true)->sum('total_amount');
        $water = Requisition::query()->where('description', "Water Bills")->where('processed', true)->sum('total_amount');
        $zesa = Requisition::query()->where('description', "Heating and Lighting")->where('processed', true)->sum('total_amount');
        $internet = Requisition::query()->where('description', "Internet")->where('processed', true)->sum('total_amount');
        $fuel = Requisition::query()->where('description', "Fuels and Oils")->where('processed', true)->sum('total_amount');
        $welfare = Requisition::query()->where('description', "Staff Welfare")->where('processed', true)->sum('total_amount');
        $transport = Requisition::query()->where('description', "Transport")->where('processed', true)->sum('total_amount');
        $license = Requisition::query()->where('description', "Licenses")->where('processed', true)->sum('total_amount');
        $repairs = Requisition::query()->where('description', "Repairs and Maintenance")->where('processed', true)->sum('total_amount');
        $research = Requisition::query()->where('description', "Research and Development")->where('processed', true)->sum('total_amount');
        $foreign = Requisition::query()->where('description', "Foreign Exchange Differences")->where('processed', true)->sum('total_amount');
        $bankCharges = Requisition::query()->where('description', "Bank Charges")->where('processed', true)->sum('total_amount');
        $bankInterest = Requisition::query()->where('description', "Bank Interest")->where('processed', true)->sum('total_amount');
        $loanInterest = Requisition::query()->where('description', "Loan Interest")->where('processed', true)->sum('total_amount');
        $fines = Requisition::query()->where('description', "Fines")->where('processed', true)->sum('total_amount');
        $travel = Requisition::query()->where('description', "Travel and Subsistence")->where('processed', true)->sum('total_amount');
        $export = Requisition::query()->where('description', "Export Marketing Expenses")->where('processed', true)->sum('total_amount');
        $local = Requisition::query()->where('description', "Local Marketing Expenses")->where('processed', true)->sum('total_amount');
        $other = Requisition::query()->where('description', "Other")->where('processed', true)->sum('total_amount');
        $debtors = Requisition::query()->where('description', "Debtors")->where('processed', true)->sum('total_amount');
        $purchases = Requisition::query()->where('description', "Purchases")->where('processed', true)->sum('total_amount');
        $inventory=PurchaseOrder::query()->sum('cost_price');
        $totalExpenses=Requisition::query()->where('processed',true)->sum('total_amount')+$inventory;
        $capital=Revenue::query()->where('name',"Capital")->sum('amount');
        $bankLoan=Revenue::query()->where('name',"Bank Loan")->sum('amount');
        $creditors=Revenue::query()->where('name',"Creditors")->sum('amount');
        $otherRevenue=Revenue::query()->where('name',"Other")->sum('amount');
        $totalRevenue=$sales+$creditors+$capital+$bankLoan+$otherRevenue;
            //$rent+$stationery+$telephone+$consultation+$salaries+$water+$zesa+$internet+$fuel+$welfare+$travel+$transport+$license+$repairs+$research+$foreign+$bankCharges+$bankInterest+$loanInterest+$fines+$export+$local+$other;
        return view('trial_balance.index', compact(
            'date', 'sales','inventory', 'rent', 'stationery', 'telephone', 'consultation', 'salaries', 'water', 'zesa', 'internet',
            'fuel','welfare','transport','license','repairs','research','foreign','bankCharges','bankInterest','loanInterest',
            'fines','export','travel','local','other','totalExpenses','totalRevenue','capital','bankLoan','otherRevenue','creditors','debtors','purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        if ($request->start_date > $request->end_date) {
            return back()->withStatus("Start date cannot be greater than end date");
        } else {
            $dat = $request->input('end_date');
            $date=Carbon::createFromFormat("Y-m-d",$dat);
            $sales = Sale::query()->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('amount');
            $rent = Requisition::query()->where('description', "Rent")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $stationery = Requisition::query()->where('description', "Stationery")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $telephone = Requisition::query()->where('description', "Telephone")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $consultation = Requisition::query()->where('description', "Consultation")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $salaries = Requisition::query()->where('description', "Salaries and Wages")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $water = Requisition::query()->where('description', "Water Bills")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $zesa = Requisition::query()->where('description', "Heating and Lighting")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $internet = Requisition::query()->where('description', "Internet")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $fuel = Requisition::query()->where('description', "Fuels and Oils")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $welfare = Requisition::query()->where('description', "Staff Welfare")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $transport = Requisition::query()->where('description', "Transport")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $license = Requisition::query()->where('description', "Licenses")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $repairs = Requisition::query()->where('description', "Repairs and Maintenance")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $research = Requisition::query()->where('description', "Research and Development")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $foreign = Requisition::query()->where('description', "Foreign Exchange Differences")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $bankCharges = Requisition::query()->where('description', "Bank Charges")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $bankInterest = Requisition::query()->where('description', "Bank Interest")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $loanInterest = Requisition::query()->where('description', "Loan Interest")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $fines = Requisition::query()->where('description', "Fines")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $travel = Requisition::query()->where('description', "Travel and Subsistence")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $export = Requisition::query()->where('description', "Export Marketing Expenses")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $local = Requisition::query()->where('description', "Local Marketing Expenses")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $other = Requisition::query()->where('description', "Other")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $debtors = Requisition::query()->where('description', "Debtors")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $purchases = Requisition::query()->where('description', "Purchases")->where('processed', true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount');
            $inventory=PurchaseOrder::query()->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('cost_price');
            $totalExpenses=Requisition::query()->where('processed',true)->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('total_amount')+$inventory;
            $capital=Revenue::query()->where('name',"Capital")->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('amount');
            $bankLoan=Revenue::query()->where('name',"Bank Loan")->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('amount');
            $creditors=Revenue::query()->where('name',"Bank Loan")->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('amount');
            $otherRevenue=Revenue::query()->where('name',"Other")->whereDate('created_at','>=',$request->input('start_date'))->whereDate('created_at','<=',$request->input('end_date'))->sum('amount');
            $totalRevenue=$sales+$creditors+$capital+$bankLoan+$otherRevenue;
            //$rent+$stationery+$telephone+$consultation+$salaries+$water+$zesa+$internet+$fuel+$welfare+$travel+$transport+$license+$repairs+$research+$foreign+$bankCharges+$bankInterest+$loanInterest+$fines+$export+$local+$other;
            return view('trial_balance.index', compact(
                'date', 'sales','inventory', 'rent', 'stationery', 'telephone', 'consultation', 'salaries', 'water', 'zesa', 'internet',
                'fuel','welfare','transport','license','repairs','research','foreign','bankCharges','bankInterest','loanInterest',
                'fines','export','travel','local','other','totalExpenses','totalRevenue','capital','bankLoan','otherRevenue','creditors','debtors','purchases'));
        }

    }

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
        $sources=Revenue::query()->where('name','Other')->get();
        return view('trial_balance.show',compact('sources'));
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
