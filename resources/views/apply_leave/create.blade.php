@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Apply Leave</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="{{route('saveLeaveApplication')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Category ID <span class="text-danger">*</span></label>
                                    {{$errors->first('leave_id')}}
                                    <input class="form-control" readonly type="text" name="leave_id" value="{{ $leave->id}}" >
                                </div>

                            </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        {{$errors->first('category')}}
                                        <input class="form-control" type="text" readonly name="category" value="{{ $leave->category}}" >
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Maximum Days <span class="text-danger">*</span></label>
                                        {{$errors->first('days')}}
                                        <input class="form-control" type="text" name="days" value="{{ old('days') }}">
                                    </div>

                                </div>


                        </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-"></label>
                                <div class="col-md-12">
                                    <button class="btn btn-success form-control" type="submit">{{ __('Apply Leave') }}</button>
                                </div>
                            </div>



                    </form>
                </div>
            </div>

@endsection
