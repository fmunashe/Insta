<?php

namespace App\Http\Controllers;

use App\Imports\PayRollsImport;
use App\PayRoll;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PayRollsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Product::class);
        $pays=PayRoll::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('payRolls.index',compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny',Product::class);
        return view('payRolls.create');
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
        $this-> validate($request,[
            'import_file'=>'required'
        ]);

        Excel::import(new PayRollsImport, request()->file('import_file'));

        Alert::warning('Successful', "PayRoll Uploaded")->persistent('Dismiss');

        return redirect('/payRolls');
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
        //
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
        $this->authorize('viewAny',Product::class);

        $pay=PayRoll::find($id);
        if($pay->status==0){
        $pay->delete();
        Alert::warning('Successful', "not allowed ")->persistent('Dismiss');
            return redirect('/payRolls');}

        else{
            Alert::warning('Warning', "not allowed ")->persistent('Dismiss');
            return redirect('/payRolls');
        }
    }
    public function authoriseSalary(PayRoll $salary){
        $this->authorize('viewAny',Product::class);
        if($salary->status==0){
            $salary->update([
                    'status'=>1,
                ]
            );

            Alert::info('Warning', "paid ")->persistent('Dismiss');
            return redirect('/payRolls');

        }
        else{
            Alert::warning('Warning', "not allowed ")->persistent('Dismiss');
            return redirect('/payRolls');
        }



    }
    public function rejectSalary(PayRoll $salary)
    {


        if ($salary->status == 0) {
            $salary->update([
                    'status' => 2,
                ]
            );
            Alert::warning('Successful', "not paid")->persistent('Dismiss');
            return redirect('/payRolls');
        }
        else{
            Alert::warning('Warning', "not allowed ")->persistent('Dismiss');
            return redirect('/payRolls');
        }
    }
}
