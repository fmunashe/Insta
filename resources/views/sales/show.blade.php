@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="{{route('createSale')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-backward"></i> Back</a> <a href="#" onclick="printInvoice('printable')"><i class="custom-badge status-blue fa fa-print m-r-5">&nbsp Print</i></a></h4>
            </div>
        </div>
        <div class="row" id="printable">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                            <div class="col-6 col-sm-6 m-b-20">
                                <img src="{{asset('frontend/assets/img/logo.png')}}" class="inv-logo" alt="">
                                <ul class="list-unstyled">
                                    <li>Insta-Visionary Enterprises</li>
                                    <li><i class="fa fa-address-card"> 121 Fife Street, Bulawayo</i></li>
                                    <li><i class="fa fa-phone"> Tel: +263783700587 / +263772842534 / +263784292977,</i></li>
                                    <li><a href="#" class="fa fa-envelope-open"> Email: instavisonary@gmail.com</a></li>
                                    <li>BPN: 0200245132</li>
                                </ul>
                            </div>
                            <div class="col-6 col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-lowercasecase">Receipt #{{$SaleDetails->id}}</h3>
                                    <ul class="list-unstyled">
                                        <li>Receipt Date: <span>{{$SaleDetails->created_at}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ITEM</th>
                                    <th>MEASURE</th>
                                    <th>UNIT COST</th>
                                    <th>QUANTITY</th>
                                    <th>SUB TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($SaleDetails->saleLines as $lines)
                                    <tr>
                                        <td>{{$lines->id}}</td>
                                        <td>{{$lines->item}}</td>
                                        <td>{{$lines->unit}}</td>
                                        <td>{{$lines->price}}</td>
                                        <td>{{$lines->quantity}}</td>
                                        <td>{{$lines->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <h6>Payment Breakdown</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Currency:</th>
                                                    <td class="text-right">{{$SaleDetails->currency}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Sub Total:</th>
                                                    <td class="text-right text-primary">
                                                        <h5>{{number_format($lineTotal,2)}}</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Exchange Rate:</th>
                                                    <td class="text-right">{{"X ".$SaleDetails->rate}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td class="text-right">{{number_format($SaleDetails->amount,2)}}</td>
                                                </tr>
                                                </tbody>
                                                {{--                                                <tr>--}}
                                                {{--                                                    <td></td>--}}
                                                {{--                                                    <td class="text-right">--}}
                                                {{--                                                        <a class="dropdown-item" href="#" onclick="printInvoice('printable')"><i class="custom-badge status-green fa fa-print m-r-5">&nbsp Print</i></a>--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                </tr>--}}
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-12 bg-primary">--}}
                                {{--                                    <p>Additional Info</p>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript">
        function printInvoice(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
