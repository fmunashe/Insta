@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Employee</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="{{route('savePosition')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Position <span class="text-danger">*</span></label>
                                        {{$errors->first('name')}}
                                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="salary_id">Grade</label>
                                        <br>
                                        <label>
                                            <select class="form-control" name="salary_id" id="salary_id">
                                                @foreach($grades as $grade)

                                                    {{$errors->first('salary_id')}}
                                                    <option value="{{$grade->id}}">{{$grade->grade}}</option>
                                                 @endforeach
                                            </select>
                                        </label>

                                    </div>
                                </div>
                        </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-"></label>
                                <div class="col-md-12">
                                    <button class="btn btn-success form-control" type="submit">{{ __('Create Position') }}</button>
                                </div>
                            </div>



                    </form>
                </div>
            </div>

@endsection
