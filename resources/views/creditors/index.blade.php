@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Creditors</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{route('addCreditor')}}" class="btn btn-success float-right btn-rounded"><i
                    class="fa fa-plus"></i> Add Creditor</a>
        </div>
    </div>
    <div class="row filter-row">
        <div class="col-sm-8 col-md-4">
            <div class="form-group form-focus">
                <label class="focus-label">Creditor Id</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-8 col-md-4">
            <div class="form-group form-focus">
                <label class="focus-label">Creditor Description</label>
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

                        <th>name</th>
                        <th>address</th>
                        <th style="min-width: 110px;">phone number</th>
                        <th>Total Invoice Amount Raised</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($creditors as $creditor)
                        <tr>
                            <td>{{$creditor->name}}</td>
                            <td>{{$creditor->address}}</td>
                            <td>{{$creditor->phone_number}}</td>
                            <td>{{number_format($creditor->requisitions->sum('total_amount'),2)}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/editCreditor/{{$creditor->id}}"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                        {{--                                                <a class="dropdown-item" href="/showEmployee/{{$requisition->id}}"><i class="fa fa-eye m-r-5"></i> Show</a>--}}
                                        <a class="dropdown-item" href="/deleteCreditor/{{$creditor->id}}"><i
                                                class="fa fa-trash-o m-r-5 status-red"></i> Delete</a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$creditors->links()}}
            </div>
        </div>
    </div>

@endsection
