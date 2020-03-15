@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Accumulated Sales Report</h4>
                <table id="client" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Sale Number</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Sub-Total</th>
                        <th>Rate</th>
                        <th>Total</th>
                        <th>Unit</th>
                        <th>Currency</th>
                        <th>Cashier</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        @foreach($sale->saleLines as $line)
                            <tr>
                                <td>{{$sale->id}}</td>
                                <td>{{$line->item}}</td>
                                <td>{{$line->quantity}}</td>
                                <td>{{$line->price}}</td>
                                <td>{{$line->amount}}</td>
                                <td>{{$sale->rate}}</td>
                                <td>{{number_format($line->amount*$sale->rate,2)}}</td>
                                <td>{{$line->unit}}</td>
                                <td>{{$sale->currency}}</td>
                                <td>{{$sale->sold_by}}</td>
                                <td>{{$sale->created_at}}</td>
                            </tr>
                        @endforeach
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
                        orientation:'landscape',
                        filename: 'Sales report',
                        title: 'All Sales Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'All Sales Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                ]
            });
        });
    </script>
@endsection
