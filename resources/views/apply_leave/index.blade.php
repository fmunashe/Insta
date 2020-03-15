@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Leave Application</h4>
                </div>
{{--                <div class="col-sm-8 col-9 text-right m-b-20">--}}
{{--                    <a href="{{route('addLeave')}}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add leave</a>--}}
{{--                </div>--}}
            </div>
            <div class="row filter-row">
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Leave ID</label>
                        <input type="text" class="form-control floating">
                    </div>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Leave</label>
                        <input type="text" class="form-control floating">
                    </div>
                </div>
{{--                <div class="col-sm-6 col-md-3">--}}
{{--                    <div class="form-group form-focus select-focus">--}}
{{--                        <label class="focus-label">Role</label>--}}
{{--                        <select class="select floating">--}}
{{--                            <option>Select Role</option>--}}
{{--                            <option>Nurse</option>--}}
{{--                            <option>Pharmacist</option>--}}
{{--                            <option>Laboratorist</option>--}}
{{--                            <option>Accountant</option>--}}
{{--                            <option>Receptionist</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-sm-8 col-md-4">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Days Required</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                <tr>
                                <td>{{$application->user->name}}</td>
                                <td>{{$application->leave->category}}</td>
                                <td>{{$application->days}}</td>

                                    @if($application->status ==0)
                                       <td><span class="custom-badge status-blue">waiting authorisation</span></td>

                                        @elseif($application->status==1)
                                        <td><span class="custom-badge status-green">accepted</span></td>

                                        @elseif($application->status==2)
                                        <td><span class="custom-badge status-red">rejected</span></td>
                                        @endif

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/authoriseLeave/{{$application->id}}"><i class="fa fa-check-square-o m-r-5 text-success" ></i> Authorise </a>
                                                <a class="dropdown-item" href="/rejectLeave/{{$application->id}}"><i class="fa fa-times-circle-o m-r-5 text-danger"></i> Reject</a>


                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    @endsection
