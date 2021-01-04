@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="#" onclick="printInvoice('printable')"><i
                            class="custom-badge status-blue fa fa-print m-r-5">&nbsp Print</i></a><a href="{{route('profitAndLoss')}}"><i
                            class="custom-badge status-blue fa fa-refresh m-r-5 pull-right">&nbsp Refresh</i></a></h4>
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
                                    <h3 class="text-lowercasecase">Profit and Loss</h3>
                                    @if (session('status'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('searchProfitAndLoss')}}">
                                        @csrf
                                        <ul class="list-unstyled">
                                            <li>Start Date: <span><input type="date" name="start_date"
                                                                         class="form-control" required></span></li>
                                            <li>End Date: <span><input type="date" name="end_date" class="form-control" required></span>
                                            </li>
                                            <li><span><input type="submit"
                                                             class="form-control btn btn-success btn-rounded"
                                                             value="Filter"></span></li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive col-sm-6">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <h4>Accumulated Revenue Breakdown</h4>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Rate</th>
                                        <th>Cashier</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td>{{$sale->id}}</td>
                                            <td>{{$sale->amount}}</td>
                                            <td>{{$sale->currency}}</td>
                                            <td>{{$sale->rate}}</td>
                                            <td>{{$sale->sold_by}}</td>
                                            <td>{{$sale->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$sales->links()}}
                            </div>
                            <div class="table-responsive col-sm-6">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <h4>Accumulated Expenses Breakdown</h4>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($losses as $loss)
                                        <tr>
                                            <td>{{$loss->requisition_number}}</td>
                                            <td>{{$loss->description}}</td>
                                            <td>{{$loss->total_amount}}</td>
                                            <td>{{$loss->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$losses->links()}}
                            </div>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <h6>P/L Summary</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Total Revenue:</th>
                                                    <td class="text-right">{{number_format($revenue,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Expenses:</th>
                                                    <td class="text-right">{{number_format($expenses,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Profit / Loss :</th>
                                                    <td class="text-right">{{number_format($revenue-$expenses,2)}}</td>
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
