@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">System Users @can('create',App\User::class)<a href="{{route('createUser')}}"
                                                      class="btn btn-success btn-rounded pull-right"><i
                            class="fa fa-user-plus"></i> New User</a>@endcan</h4>
                <table id="client" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Is Cashier</th>
                        <th>Is Admin</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>@if($user->cashier)<i class="custom-badge status-green fa fa-thumbs-up">Yes</i> @else <i
                                    class="custom-badge status-red fa fa-thumbs-down">No</i> @endif</td>
                            <td>@if($user->admin)<i class="custom-badge status-green fa fa-thumbs-up">Yes</i> @else <i
                                    class="custom-badge status-red fa fa-thumbs-down">No</i> @endif</td>
                            <td>
                                @can('create',App\User::class)
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <a class="dropdown-item" href="/editUser/{{$user->id}}"><i
                                                class="custom-badge status-green fa fa-pencil m-r-5">&nbsp;
                                                Update</i></a>
                                        <a class="dropdown-item" href="/removeUser/{{$user->id}}"><i
                                                class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Remove</i></a>
                                    </div>
                                </div>
                                @endcan
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
        $(document).ready(function () {
            $('#client').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pageLength', 'colvis',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
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
                        filename: 'Users report',
                        title: 'Registered System Users Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'System Users Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ]
            });
        });
    </script>
@endsection
