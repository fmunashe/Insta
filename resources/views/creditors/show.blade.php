@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-sm-7 col-6">
                    <h4 class="page-title">{{$employee->first_name}} {{$employee->last_name}} Profile</h4>
                </div>

                <div class="col-sm-5 col-6 text-right m-b-30">
                    <a href="#" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
                </div>
            </div>
            <div class="card-box profile-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{$employee->first_name}} {{$employee->last_name}}</h3>

                                            <div class="staff-id">Position: {{$employee->position->name}}</div>

                                            <div class="staff-id">Joining date : {{$employee->joining_date}}</div>
                                            <br>
                                            <br>
                                            @if($employee->status ==1)
                                                <div class="staff-id">Status :
                                                <span class="custom-badge status-green">Active</span></div>

                                            @elseif($employee->status==0)
                                            <div class="staff-id">Status :
                                               <span class="custom-badge status-red">Inactive</span></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text">{{$employee->mobile_number}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text">{{$employee->email}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Date of birth:</span>
                                                <span class="text">{{$employee->date_of_birth}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Address:</span>
                                                <span class="text">{{$employee->address}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Gender:</span>
                                                <span class="text">{{$employee->gender}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Salary and allowance</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Leave Days</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="about-cont">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h3 class="card-title">Highest Education Information</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div>
                                                        <div>College Name :{{$employee->school}}</div>
                                                        <div>Attained Qualification :{{$employee->attained}}</div>
                                                        <span>Completion Year :{{$employee->completion_year}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
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
                                                    <div>
                                                        <div>Company :{{$employee->company}}</div>
                                                        <div>Position :{{$employee->position_held}}</div>
                                                        <span>Period :{{$employee->position_years." Years"}}</span>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-tab2">
                        Tab content 2
                    </div>
                    <div class="tab-pane" id="bottom-tab3">
                        Tab content 3
                    </div>
                </div>
                </div>

@endsection
