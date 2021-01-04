<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/logo.png')}}">
    <title>InstaVisionary</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
    <![endif]-->
    @livewireStyles
    @livewireScripts
    @yield('styles')
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('frontend/assets/img/logo.png')}}" width="50" height="50" alt="">&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;<span><strong><h2>InstaV</h2></strong></span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="{{asset('frontend/assets/img/user.jpg')}}" width="24"
                                 alt="Admin">
							<span class="status online"></span>
						</span>
                    <span>{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu">
                    <i class="status-green">Role: {{auth()->user()->admin?" Administrator":"Cashier"}}</i>
                    <a class="dropdown-item custom-badge badge-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    <li class="active">
                        <a href="{{route('home')}}"><i class="fa fa-home text-primary"></i> <span>Home</span></a>
                    </li>
                    @can('create',App\User::class)
                    <li class="submenu">
                        <a href="#"><i class="fa fa-cogs text-primary"></i> <span>Configurables </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('categories')}}"><i class="fa fa-group text-primary"></i><span> Product Categories</span></a>
                            </li>
                            <li><a href="{{route('units')}}"><i class="fa fa-balance-scale text-primary"></i> Unit of
                                    Measure </a></li>
                            <li><a href="{{route('currencies')}}"><i class="fa fa-usd text-primary"></i> Currencies </a>
                            </li>
                            <li><a href="{{route('rates')}}"><i class="fa fa-exchange text-primary"></i> Exchange Rates
                                </a></li>
                            <li><a href="{{route('creditors')}}"><i class="fa fa-exchange text-primary"></i> Creditors
                                </a></li>
                            <li><a href="{{route('suppliers')}}"><i class="fa fa-superpowers text-primary"></i> Suppliers
                                </a></li>
                            <li><a href="{{route('users')}}"><i class="fa fa-users text-primary"></i> Manage Users
                                </a></li>
                            <li><a href="{{route('createRevenue')}}"><i class="fa fa-money text-primary"></i> Revenue Income
                                </a></li>
                        </ul>
                    </li>
                    @endcan
                    <li class="submenu">
                        <a href="#"><i class="fa fa-shopping-cart text-primary"></i> <span>Front Office Menu </span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('createSale')}}"><i class="fa fa-cart-plus text-primary"></i><span> Sales Dashboard</span></a>
                            </li>
                            <li><a href="{{route('invoices')}}"><i class="fa fa-envelope-open-o text-primary"></i> Invoices</a></li>
                            <li><a href="{{route('quotations')}}"><i class="fa fa-address-card text-primary"></i> Quotations</a></li>
                            <li><a href="{{route('requisitions')}}"><i class="fa fa-gavel text-primary"></i> Requisitions</a></li>
                        </ul>
                    </li>
                    @can('viewAny',App\Product::class)
{{--                    <li class="submenu">--}}
{{--                        <a href="#"><i class="fa fa-users text-primary"></i> <span>Human Resources </span> <span--}}
{{--                                class="menu-arrow"></span></a>--}}
{{--                        <ul style="display: none;">--}}
{{--                            <li class="submenu">--}}
{{--                                <a href="{{route('employees')}}"><i class="fa fa-user text-primary"></i> <span> Employees </span> <span class="menu-arrow"></span></a>--}}
{{--                                <ul style="display: none;">--}}
{{--                                    <li><a href="{{route('employees')}}">Employees List</a></li>--}}
{{--                                    <li><a href="{{route('employeePositions')}}" >Positions</a></li>--}}
{{--                                    <li><a href="{{route('leaves')}}">Leaves</a></li>--}}
{{--                                    <li><a href="{{route('LeaveApplication')}}">Leave Application</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="submenu">--}}
{{--                                <a href="#"><i class="fa fa-book text-primary"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>--}}
{{--                                <ul style="display: none;">--}}
{{--                                    <li><a href="{{route('payRolls')}}"> PayRoll </a></li>--}}
{{--                                    <li><a href="#"> Payslip </a></li>--}}
{{--                                    <li><a href="{{route('salaryGrade')}}"> Pay Grades </a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <li class="submenu">
                        <a href="#"><i class="fa fa-bar-chart text-primary"></i> <span> Inventory </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('products')}}"><i class="fa fa-cart-plus text-primary"></i><span> Products</span></a>
                            </li>
                            <li><a href="{{route('orders')}}"><i class="fa fa-balance-scale text-primary"></i> Receive Stock </a></li>
                            <li><a href="{{route('stockTakes')}}"><i class="fa fa-exchange text-primary"></i> Stock Take </a>
                            </li>
                            <li><a href="{{route('assets')}}"><i class="fa fa-cab text-primary"></i> Assets</a>
                        </ul>
                    </li>
                    @endcan
                    <li class="submenu">
                        <a href="#"><i class="fa fa-tasks text-danger"></i> <span> Reports </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           @can('viewAny',App\Product::class)
                            <li><a href="{{route('sales')}}"><i class="fa fa-signal text-danger"></i><span> Sales</span></a></li>
                            <li><a href="{{route('profitAndLoss')}}"><i class="fa fa-balance-scale text-danger"></i>Profit and Loss </a></li>
                            <li><a href="{{route('trialBalance')}}"><i class="fa fa-tripadvisor text-danger pr-1"></i>&nbsp;  Trial Balance </a></li>

                            @endcan
                            <li><a href="{{route('mySales')}}"><i class="fa fa-bar-chart-o text-danger"></i><span> Sales Summary</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="{{asset('frontend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('frontend/assets/js/Chart.bundle.js')}}"></script>
<script src="{{asset('frontend/assets/js/chart.js')}}"></script>
<script src="{{asset('frontend/assets/js/app.js')}}"></script>
@yield('javascripts')
@include('sweetalert::alert')
</body>
</html>
