@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">System Generated Quotations <a href="{{route('createQuotation')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Quotation</a></h4>
                <table id="client" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Quotation Number</th>
                        <th>Quotation Description</th>
                        <th>Currency</th>
                        <th>Rate</th>
                        <th>Quotation Amount</th>
                        {{--                        <th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotations as $quotation)
                        <tr>
                            <td>{{$quotation->id}}</td>
                            <td><a href="/showQuotation/{{$quotation->id}}">{{$quotation->quotation_number}}</a></td>
                            <td>{{$quotation->quotation_description}}</td>
                            <td>{{$quotation->currency}}</td>
                            <td>{{$quotation->rate}}</td>
                            <td>{{$quotation->quotation_amount}}</td>
                            {{--                            <td>--}}
                            {{--                                <div class="dropdown dropdown-action">--}}
                            {{--                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>--}}
                            {{--                                    <div class="dropdown-menu dropdown-menu-right">--}}
                            {{--                                        <a class="dropdown-item" href="/showInvoice/{{$invoice->id}}"><i class="custom-badge status-green fa fa-eye m-r-5">&nbsp; Show</i></a>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </td>--}}
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
                        filename: 'Quotation report',
                        title:'All System Quotation Report',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5 ]
                        }
                    },
                    {
                        extend: 'print',
                        title:'All System Quotations Report',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5]
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
