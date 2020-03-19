<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/favi.ico')}}">
    <title>StockMan</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
    <![endif]-->
    @yield('styles')
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('frontend/assets/img/chikwereti2.png')}}" width="50" height="50" alt="">&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;<span><strong><h2>StockMan</h2></strong></span>
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
                    <i class="status-green">Role:</i>
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
                        <a href="{{route('home')}}"><i class="fa fa-home text-success"></i> <span>Home</span></a>
                    </li>
                    @can('create',App\User::class)
                    <li class="submenu">
                        <a href="#"><i class="fa fa-cogs text-success"></i> <span>Configurables </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('categories')}}"><i class="fa fa-group text-success"></i><span> Product Categories</span></a>
                            </li>
                            <li><a href="{{route('units')}}"><i class="fa fa-balance-scale text-success"></i> Unit of
                                    Measure </a></li>
                            <li><a href="{{route('currencies')}}"><i class="fa fa-usd text-success"></i> Currencies </a>
                            </li>
                            <li><a href="{{route('rates')}}"><i class="fa fa-exchange text-success"></i> Exchange Rates
                                </a></li>
                            <li><a href="{{route('users')}}"><i class="fa fa-users text-success"></i> Manage Users
                                </a></li>
                        </ul>
                    </li>
                    @endcan
                    <li class="submenu">
                        <a href="#"><i class="fa fa-shopping-cart text-success"></i> <span>Front Office Menu </span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('createSale')}}"><i class="fa fa-cart-plus text-success"></i><span> Sales Dashboard</span></a>
                            </li>
                            <li><a href="{{route('invoices')}}"><i class="fa fa-envelope-open-o text-success"></i> Invoices</a></li>
                            <li><a href="{{route('quotations')}}"><i class="fa fa-address-card text-success"></i> Quotations</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-users text-success"></i> <span>Human Resources </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="submenu">
                                <a href="{{route('employees')}}"><i class="fa fa-user text-success"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{route('employees')}}">Employees List</a></li>
                                    <li><a href="{{route('employeePositions')}}" >Positions</a></li>
                                    <li><a href="{{route('leaves')}}">Leaves</a></li>
                                    <li><a href="{{route('LeaveApplication')}}">Leave Application</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fa fa-book text-success"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{route('payRolls')}}"> PayRoll </a></li>
                                    <li><a href="#"> Payslip </a></li>
                                    <li><a href="{{route('salaryGrade')}}"> Pay Grades </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-bar-chart text-success"></i> <span> Inventory </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('products')}}"><i class="fa fa-cart-plus text-success"></i><span> Products</span></a>
                            </li>
                            <li><a href="{{route('orders')}}"><i class="fa fa-balance-scale text-success"></i> Purchase
                                    Orders </a></li>
                            <li><a href="{{route('stockTakes')}}"><i class="fa fa-exchange text-success"></i> Stock Take </a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-tasks text-danger"></i> <span> Reports </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('sales')}}"><i class="fa fa-signal text-danger"></i><span> Sales</span></a></li>
                            <li><a href=""><i class="fa fa-upload text-danger"></i>Upload Batch </a></li>
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
