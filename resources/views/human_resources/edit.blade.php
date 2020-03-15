@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h4 class="page-title">Edit Employee</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <form method="post" action="/updateEmployee/{{$employee->id}}" >
                        <input type="hidden" name="_method" value="PUT">
                    @csrf
                        <div class="card-box mb-0">
                            <h3 class="card-title">Personal Information</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                {{$errors->first('first_name')}}
                                <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="{{$employee->first_name}}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                {{$errors->first('last_name')}}
                                <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="{{$employee->last_name}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                {{$errors->first('email')}}
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}"  placeholder="{{$employee->email}}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Joining Date <span class="text-danger">*</span></label>
                                {{$errors->first('joining_date')}}
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="joining_date" value="{{ old('joining_date') }}" placeholder="{{$employee->joining_date}}">
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone </label>
                                {{$errors->first('mobile_number')}}
                                <input class="form-control" type="text" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="{{$employee->mobile_number}}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="position_id">Position</label>
                                <br>
                                <label>
                                    <select class="form-control" name="position_id" id="position_id" >
                                        @foreach($positions as $position)

                                            {{$errors->first('position_id')}}
                                            <option value="{{$position->id}}" >{{$position->name}}</option>
                                        @endforeach
                                    </select>
                                </label>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth <span class="text-danger">*</span></label>
                                {{$errors->first('date_of_birth')}}
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="{{$employee->date_of_birth}}">
                                </div>
                            </div>

                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                {{$errors->first('gender')}}
                                <br>
                                <label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="male">male</option>
                                        <option value="female">female</option>
                                    </select>
                                </label>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Residential Adress </label>
                                {{$errors->first('address')}}
                                <input class="form-control" type="text" name="address" value="{{ old('address') }}" placeholder="{{$employee->address}}">
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="display-block">Status</label>
                                {{$errors->first('status')}}
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="employee_active" value="1" checked>
                                    <label class="form-check-label" for="employee_active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="employee_inactive" value="0">
                                    <label class="form-check-label" for="employee_inactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>
                        </div>


                    <form class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Highest Education Attained</h3>
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <div class="col-sm">
                                                            <div class="form-group">
                                                                <label>School <span class="text-danger">*</span></label>
                                                                {{$errors->first('school')}}
                                                                <input class="form-control" type="text" name="school" value="{{ old('school') }}" placeholder="{{$employee->school}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <div class="col-sm">
                                                            <div class="form-group">
                                                                <label>Attained Qualification</label>
                                                                {{$errors->first('attained')}}
                                                                <input class="form-control" type="text" name="attained" value="{{ old('attained') }}" placeholder="{{$employee->attained}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <div class="col-sm">
                                                            <div class="form-group">
                                                                <label> year of completion <span class="text-danger">*</span></label>
                                                                {{$errors->first('completion_year')}}
                                                                <div class="cal-icon">
                                                                    <input class="form-control datetimepicker" type="text" name="completion_year" value="{{ old('completion_year') }}" placeholder="{{$employee->completion_year}}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>



                                    </div>
                                    <div class="card-box mb-0">
                                        <h3 class="card-title">Last Work Experience</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <div class="col-sm">
                                                                <div class="form-group">
                                                                    <label>Company <span class="text-danger">*</span></label>
                                                                    {{$errors->first('company')}}
                                                                    <input class="form-control" type="text" name="company" value="{{ old('company') }}" placeholder="{{$employee->company}}">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <div class="col-sm">
                                                                <div class="form-group">
                                                                    <label>Position <span class="text-danger">*</span></label>
                                                                    {{$errors->first('position_held')}}
                                                                    <input class="form-control" type="text" name="position_held" value="{{ old('position_held') }}" placeholder="{{$employee->position_held}}">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <div class="col-sm">
                                                                <div class="form-group">
                                                                    <label> Number of years <span class="text-danger">*</span></label>
                                                                    {{$errors->first('position_years')}}
                                                                    <div class="cal-icon">
                                                                        <input class="form-control datetimepicker" type="text" name="position_years" value="{{ old('position_years') }}" placeholder="{{$employee->position_years}}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <br>

                        <div class="form-group row">
                            <label class="col-form-label col-md-"></label>
                            <div class="col-md-12">
                                <button class="btn btn-success form-control" type="submit">{{ __('Update Employee Details') }}</button>
                            </div>
                        </div>

                    </form>
                    </div>
                </div>
            </div>

@endsection
