<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeavesController extends Controller
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
        $leaves=Leave::query()->paginate('20');

        return view('leaves.index',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny',Product::class);
        return view('leaves.create');
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
        $data=$this-> validate($request,[
            'category'=>'required',
            'days'=>'required'
        ]);
        Leave::query()->create($data);
        return redirect()->route('leaves')->withSuccessMessage("Leave Created");
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
        $leave=Leave::query()->find($id);
        return view('leaves.show',compact('leave'));
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
        $leave=Leave::query()->find($id);
        return view('leaves.edit',compact('leave'));
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
        $data=$this-> validate($request,[
            'category'=>'required',
            'days'=>'required'
        ]);
        Leave::query()->where('id',$id)->update($data);
        return redirect()->route('leaves')->withSuccessMessage("Leave Updated");

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
        Leave::query()->where('id',$id)->delete();
        return redirect()->route('leaves')->withSuccessMessage("Leave Removed");
    }
}
