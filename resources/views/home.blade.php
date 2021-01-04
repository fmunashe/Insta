@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="col-lg-12 col-xs-12">
                                    {!! $sales->html() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="col-lg-12 col-xs-12">
                                    {!! $expenses->html() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="col-lg-12 col-xs-12">
                                    {!! $products->html() !!}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $sales->script() !!}
{!! $expenses->script() !!}
{!! $products->script() !!}
@endsection
