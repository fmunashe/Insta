@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-18">
            <div class="card-box">
                <h4 class="card-title"> Assets<a href="{{route('addAsset')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Add Asset</a></h4>
                <table id="client" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
{{--                        <th>asset number</th>--}}
{{--                        <th>asset name</th>--}}
{{--                        <th>asset location</th>--}}
{{--                        <th>asset classification</th>--}}
{{--                        <th>date acquired</th>--}}
{{--                        <th>depreciation method</th>--}}
                        <th>life span</th>
                        <th>depreciation rate</th>
                        <th>narration</th>
                        <th>invoice number</th>
                        <th>invoice details</th>
                        <th>purchase price</th>
                        <th>transport cost</th>
                        <th>other cost</th>
                        <th>depreciation</th>
                        <th>total cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assets as $asset)
                        <tr>
{{--                            <td>{{$asset->asset_number}}</td>--}}
{{--                            <td>{{$asset->asset_name}}</td>--}}
{{--                            <td>{{$asset->asset_location}}</td>--}}
{{--                            <td>{{$asset->asset_classification}}</td>--}}
{{--                            <td>{{$asset->date_acquired}}</td>--}}
{{--                          <td>{{$asset->dep_method}}</td>--}}
                            <td>{{$asset->span}}</td>
                            <td>{{$asset->dep_rate}}</td>
                            <td>{{$asset->narration}}</td>
                            <td>{{$asset->invoice_number}}</td>
                            <td>{{$asset->invoice_details}}</td>
                            <td>{{$asset->purchase_price}}</td>
                            <td>{{$asset->transport_cost}}</td>
                            <td>{{$asset->other_cost}}</td>
                            <td>{{$asset->depreciation}}</td>
                            <td>{{$asset->total_cost}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/editAsset/{{$asset->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Update Asset</i></a>
                                        <a class="dropdown-item" href="/deleteAsset/{{$asset->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
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
                        filename: 'Products report',
                        title:'All Products Report',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7 ]
                        }
                    },
                    {
                        extend: 'print',
                        title:'All Products Report',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7]
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
