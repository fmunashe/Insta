@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="#" onclick="printInvoice('printable')"><i
                            class="custom-badge status-blue fa fa-print m-r-5">&nbsp Print</i></a><a
                        href="{{route('trialBalance')}}"><i
                            class="custom-badge status-blue fa fa-backward m-r-5 pull-right">&nbsp Back</i></a></h4>
            </div>
        </div>
        <div class="row" id="printables">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                            <div class="col-6 col-sm-6 m-b-20">
                                <img src="{{asset('frontend/assets/img/logo.png')}}" class="inv-logo" alt="">
                                <ul class="list-unstyled">
                                    <li>Insta-Visionary Enterprises</li>
                                    <li><i class="fa fa-address-card"> 121 Fife Street, Bulawayo</i></li>
                                    <li><i class="fa fa-phone"> Tel: +263783700587 / +263772842534 / +263784292977,</i>
                                    </li>
                                    <li><a href="#" class="fa fa-envelope-open"> Email: instavisonary@gmail.com</a></li>
                                    <li>BPN: 0200245132</li>
                                </ul>
                            </div>
                            <div class="col-6 col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-lowercasecase">Other Revenue Sources</h3>
                                    @if (session('status'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" id="printable">
                            <div class="col-sm-12">
                                <div class="card">
                                    <h3 class="card-header-pills alert-info" style="text-align: center">Other Revenue
                                        Sources for InstaVisionary</h3>
                                    <div class="card-body">
                                        <table class="table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sources as $source)
                                                <tr>
                                                <td>{{$source->description}}</td>
                                                <td>{{$source->amount}}</td>
                                                <td>{{$source->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
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
