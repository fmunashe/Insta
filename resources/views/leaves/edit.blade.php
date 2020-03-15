@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Leave</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="/updateLeave/{{$leave->id}}" >
                        <input type="hidden" name="_method" value="PUT">
                    @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    {{$errors->first('category')}}
                                    <input class="form-control" type="text" name="category" value="{{ old('category') }}" placeholder="{{$leave->category}}">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Maximum Days <span class="text-danger">*</span></label>
                                    {{$errors->first('days')}}
                                    <input class="form-control" type="text" name="days" value="{{ old('days') }}" placeholder="{{$leave->days}}">
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-"></label>
                            <div class="col-md-12">
                                <button class="btn btn-success form-control" type="submit">{{ __('Save') }}</button>
                            </div>
                        </div>
                        </form>
                </div>
            </div>


@endsection
