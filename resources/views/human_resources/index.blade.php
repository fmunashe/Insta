@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Employee</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{route('addEmployee')}}" class="btn btn-success float-right btn-rounded"><i class="fa fa-plus"></i> Add Employee</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Employee ID</label>
                        <input type="text" class="form-control floating">
                    </div>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Employee Name</label>
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
                                <th style="min-width:200px;">Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th style="min-width: 110px;">Join Date</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                <td><h2>{{$employee->first_name}} {{$employee->last_name}}</h2></td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->mobile_number}}</td>
                                <td>{{$employee->joining_date}}</td>
                                @if($employee->status ==1)
                                        <td><a href="/deactivate_employee/{{$employee->id}}/update"><span class="custom-badge status-green">Active</span></a></td>

                                @elseif($employee->status==0)
                                        <td><a href="/activate_employee/{{$employee->id}}/update"><span class="custom-badge status-red">Inactive</span></a></td>
                               @endif

                                <td><span class="custom-badge status-green">{{$employee->position->name}}</span></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/editEmployee/{{$employee->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="/showEmployee/{{$employee->id}}"><i class="fa fa-eye m-r-5"></i> Show</a>
                                                <a class="dropdown-item" href="/deleteEmployee/{{$employee->id}}"><i class="fa fa-trash-o m-r-5 status-red"></i> Delete</a>

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
