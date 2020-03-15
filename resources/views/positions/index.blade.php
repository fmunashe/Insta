@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Position</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{route('addPosition')}}" class="btn btn-success float-right btn-rounded"><i class="fa fa-plus"></i> Add Position</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Position ID</label>
                        <input type="text" class="form-control floating">
                    </div>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Position Name</label>
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
                                <th style="min-width:200px;">Position</th>
                                <th>Grade</th>
                                <th>Salary</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($positions as $position)
                                <tr>
                                <td><h2>{{$position->name}}</h2></td>
                                <td>{{$position->salary->grade}}</td>
                                <td>{{$position->salary->amount}}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/editPosition/{{$position->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
{{--                                                <a class="dropdown-item" href="/showPosition/{{$position->id}}"><i class="fa fa-eye m-r-5"></i> Show</a>--}}
                                                <a class="dropdown-item" href="/deletePosition/{{$position->id}}"><i class="fa fa-trash-o m-r-5 status-red"></i> Delete</a>

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
