@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Payroll<a href="{{route('uploadPayRoll')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Upload PayRollBatcht</a></h4>
                <table id="client" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>batch number</th>
                        <th>date</th>
                        <th>Employee Name</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Allowance</th>
                        <th>Deductions</th>
                        <th>total</th>
                        <th>Status</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                    @foreach($pays as $roll)
                        <tr>
                            <td>{{$roll->id}}</td>

                            <td>{{$roll->roll_number}}</td>
                            <td>{{$roll->created_at}}</td>
                            <td>{{$roll->employee->first_name}} {{$roll->employee->last_name}}</td>
                            <td>{{$roll->employee->position->name}} </td>
                            <td>{{$roll->salary}}</td>
                            <td>{{$roll->allowance}}</td>
                            <td>{{$roll->deductions}}</td>
                            <td>{{$roll->total}}</td>
                            @if($roll->status ==0)
                                <td><span class="custom-badge status-blue">waiting authorisation</span></td>

                            @elseif($roll->status==1)
                                <td><span class="custom-badge status-green">paid</span></td>

                            @elseif($roll->staus==2)
                                <td><span class="custom-badge status-red">not paid</span></td>
                            @endif
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item" href="/authoriseSalary/{{$roll->id}}"><i class="fa fa-check-square-o m-r-5 text-success" ></i> Authorise </a>
                                        <a class="dropdown-item" href="/rejectSalary/{{$roll->id}}"><i class="fa fa-times-circle-o m-r-5 text-danger"></i> Reject</a>
                                        <a class="dropdown-item" href="/deletePayRoll/{{$roll->id}}"><i class="fa fa-trash m-r-5 text-danger"></i> Delete</a>
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
@section('javascripts')
    <script src=" https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src=" https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#client').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'pageLength','colvis',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        filename: 'Payroll report',
                        title:'Payroll Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7,8,9 ]
                        }
                    },
                    {
                        extend: 'print',
                        orientation:'landscape',
                        title:'Payroll Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7,8,9 ]
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
