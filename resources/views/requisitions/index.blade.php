@extends('layouts.app')
@section('content')

            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Requisitions</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{route('addRequisition')}}" class="btn btn-success float-right btn-rounded"><i class="fa fa-plus"></i> Add Requisition</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Requisition Id</label>
                        <input type="text" class="form-control floating">
                    </div>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="form-group form-focus">
                        <label class="focus-label">Requisition Description</label>
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
                                <th style="min-width:200px;">requisition number</th>
                                <th>Creditor</th>
                                <th>description</th>
                                <th style="min-width: 110px;">status</th>
                                <th>processed</th>
                                <th>vatable</th>
                                <th>vat</th>
                                <th>amount</th>
                                <th>total amount</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requisitions as $requisition)
                                <tr>
                                <td>{{$requisition->requisition_number}}</td>
                                    @foreach($requisition->creditors as $creditor)
                                        <td>{{$creditor->name}}</td>
                                        @endforeach
                                <td>{{$requisition->description}}</td>

                                @if($requisition->status ==1)
                                        <td><a href="/rejectRequisition/{{$requisition->id}}/update"><span class="custom-badge status-green">authorised</span></a></td>
                                    @elseif($requisition->status==2)
                                        <td><a href="/acceptRequisition/{{$requisition->id}}/update"><span class="custom-badge status-green">rejected</span></a></td>
                                @elseif($requisition->status==0)
                                        <td><a href="/acceptRequisition/{{$requisition->id}}/update"><span class="custom-badge status-red">waiting authorisation</span></a></td>
                               @endif

                                    @if($requisition->processed ==1)
                                        <td><a href="/rejectPayment/{{$requisition->id}}"><span class="custom-badge status-green">paid</span></a></td>

                                    @elseif($requisition->processed==0)
                                        <td><a href="/authorisePayment/{{$requisition->id}}"><span class="custom-badge status-red">not paid</span></a></td>
                                    @endif

                                    @if($requisition->vatable ==1)
                                        <td><span class="custom-badge status-green">yes</span></td>

                                    @elseif($requisition->vatable==0)
                                        <td><span class="custom-badge status-red">no</span></td>
                                    @endif
                                    <td>{{number_format($requisition->vat_amount,2)}}</td>
                                    <td>{{number_format($requisition->amount,2)}}</td>
                                    <td>{{number_format($requisition->total_amount,2)}}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @can('create',App\Requisition::class)
                                                <a class="dropdown-item" href="/editRequisition/{{$requisition->id}}"><i
                                                        class="custom-badge status-orange fa fa-pencil m-r-5">&nbsp;
                                                        Edit</i></a>
                                                    <a class="dropdown-item" href="/authorisePayment/{{$requisition->id}}"><i
                                                            class="custom-badge status-green fa fa-money m-r-5">&nbsp;
                                                            Pay</i></a>
                                                    <a class="dropdown-item" href="/deleteEmployee/{{$requisition->id}}"><i
                                                            class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Roll back</i></a>
                                                @endcan
                                                @can('viewAny',App\Requisition::class)
                                                <a class="dropdown-item" href="/acceptRequisition/{{$requisition->id}}/update"><i
                                                        class="custom-badge status-green fa fa-pencil m-r-5">&nbsp;
                                                        Approve</i></a>
                                                <a class="dropdown-item" href="/rejectRequisition/{{$requisition->id}}/update"><i
                                                        class="custom-badge status-purple fa fa-pencil m-r-5">&nbsp;
                                                        Decline</i></a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$requisitions->links()}}
                    </div>
                </div>
            </div>

    @endsection
