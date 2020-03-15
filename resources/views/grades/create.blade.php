@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Grade</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="{{route('saveSalaryGrade')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Grade <span class="text-danger">*</span></label>
                                        {{$errors->first('grade')}}
                                        <input class="form-control" type="text" name="grade" value="{{ old('grade') }}">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Amount <span class="text-danger">*</span></label>
                                        {{$errors->first('amount')}}
                                        <input class="form-control" type="text" name="amount" value="{{ old('amount') }}">
                                    </div>

                                </div>


                        </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-"></label>
                                <div class="col-md-12">
                                    <button class="btn btn-success form-control" type="submit">{{ __('Create Grade') }}</button>
                                </div>
                            </div>



                    </form>
                </div>
            </div>

@endsection
