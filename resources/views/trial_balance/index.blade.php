@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="#" onclick="printInvoice('printable')"><i
                            class="custom-badge status-blue fa fa-print m-r-5">&nbsp Print</i></a><a href="{{route('trialBalance')}}"><i
                            class="custom-badge status-blue fa fa-refresh m-r-5 pull-right">&nbsp Refresh</i></a></h4>
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
                                    <li><i class="fa fa-phone"> Tel: +263783700587 / +263772842534 / +263784292977,</i></li>
                                    <li><a href="#" class="fa fa-envelope-open"> Email: instavisonary@gmail.com</a></li>
                                    <li>BPN: 0200245132</li>
                                </ul>
                            </div>
                            <div class="col-6 col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-lowercasecase">Trial Balance</h3>
                                    @if (session('status'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('searchTrialBalance')}}">
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

                        <div class="row" id="printable">
                            <div class="col-sm-12">
                            <div class="card">
                                <h3 class="card-header-pills alert-info" style="text-align: center">InstaVisionary Trial Balance as at @if($date) {{date_format($date,"Y-m-d")}}@else{{date_format(now(),"Y-m-d")}}@endif</h3>
                           <div class="card-body">
                               <table class="table table-sm table-bordered table-striped table-hover">
                                   <thead>
                                   <tr>
                                       <th rowspan="2">Sr.No</th>
                                       <th rowspan="2">Particulars</th>
                                       <th colspan="2" style="text-align: center">Amount</th>
                                   </tr>
                                   <tr>
                                      <th>Dr</th>
                                       <th>Cr</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                       <td>1.</td>
                                       <td>Capital</td>
                                       <td></td>
                                       <td>{{number_format($capital,2)}}</td>
                                   </tr>
                                   <tr>
                                       <td>2.</td>
                                       <td>Sales</td>
                                       <td></td>
                                       <td>{{number_format($sales,2)}}</td>
                                   </tr>
                                   <tr>
                                       <td>3.</td>
                                       <td>Inventory</td>
                                       <td>{{number_format($inventory,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>4.</td>
                                       <td>Bank Loan</td>
                                       <td></td>
                                       <td>{{number_format($bankLoan,2)}}</td>
                                   </tr>
                                   <tr>
                                       <td>5.</td>
                                       <td>Rent</td>
                                       <td>{{number_format($rent,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>6.</td>
                                       <td>Stationery</td>
                                       <td>{{number_format($stationery,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>7.</td>
                                       <td>Telephone</td>
                                       <td>{{number_format($telephone,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>8.</td>
                                       <td>Consultation</td>
                                       <td>{{number_format($consultation,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>9.</td>
                                       <td>Salaries and Wages</td>
                                       <td>{{number_format($salaries,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>10.</td>
                                       <td>Water Bills</td>
                                       <td>{{number_format($water,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>11.</td>
                                       <td>Heating and Lighting</td>
                                       <td>{{number_format($zesa,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>12.</td>
                                       <td>Internet</td>
                                       <td>{{number_format($internet,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>13.</td>
                                       <td>Fuels and Oils</td>
                                       <td>{{number_format($fuel,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>14.</td>
                                       <td>Staff Welfare</td>
                                       <td>{{number_format($welfare,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>15.</td>
                                       <td>Transport</td>
                                       <td>{{number_format($transport,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>16.</td>
                                       <td>Licenses</td>
                                       <td>{{number_format($license,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>17.</td>
                                       <td>Repairs and Maintenance</td>
                                       <td>{{number_format($repairs,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>18.</td>
                                       <td>Research and Development</td>
                                       <td>{{number_format($research,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>19.</td>
                                       <td>Foreign Exchange Differences</td>
                                       <td>{{number_format($foreign,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>20.</td>
                                       <td>Bank Charges</td>
                                       <td>{{number_format($bankCharges,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>21.</td>
                                       <td>Bank Interest</td>
                                       <td>{{number_format($bankInterest,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>22.</td>
                                       <td>Loan Interest</td>
                                       <td>{{number_format($loanInterest,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>23.</td>
                                       <td>Fines</td>
                                       <td>{{number_format($fines,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>24.</td>
                                       <td>Travel and Subsistence</td>
                                       <td>{{number_format($travel,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>25.</td>
                                       <td>Export Marketing Expenses</td>
                                       <td>{{number_format($export,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>26.</td>
                                       <td>Local Marketing Expenses</td>
                                       <td>{{number_format($local,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>27.</td>
                                       <td>Debtors</td>
                                       <td>{{number_format($debtors,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>28.</td>
                                       <td>Purchases</td>
                                       <td>{{number_format($purchases,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>29.</td>
                                       <td>Any Other Expenses</td>
                                       <td>{{number_format($other,2)}}</td>
                                       <td></td>
                                   </tr>
                                   <tr>
                                       <td>30.</td>
                                       <td>Creditors</td>
                                       <td></td>
                                       <td>{{number_format($creditors,2)}}</td>
                                   </tr>
                                   <tr>
                                       <td>31.</td>
                                       <td>Other Revenue Sources</td>
                                       <td></td>
                                       <td><a href="/showRevenue/Other" class="badge badge-danger">{{number_format($otherRevenue,2)}}</a></td>
                                   </tr>
                                   </tbody>
                                   <tfoot>
                                   <tr class="alert-info">
                                       <th></th>
                                       <th>Total</th>
                                       <th>{{number_format($totalExpenses,2)}}</th>
                                       <th>{{number_format($totalRevenue,2)}}</th>
                                   </tr>
                                   </tfoot>
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
