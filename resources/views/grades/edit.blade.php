@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Grade</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="/updateSalaryGrade/{{$grade->id}}" >
                        <input type="hidden" name="_method" value="PUT">
                    @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Grade <span class="text-danger">*</span></label>
                                    {{$errors->first('grade')}}
                                    <input class="form-control" type="text" name="grade" value="{{ old('grade') }}" placeholder="{{$grade->grade}}">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Position <span class="text-danger">*</span></label>
                                    {{$errors->first('amount')}}
                                    <input class="form-control" type="text" name="amount" value="{{ old('amount') }}" placeholder="{{$grade->amount}}">
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
