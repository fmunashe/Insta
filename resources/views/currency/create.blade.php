@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Currency / Mode of Payment</h4>
                <form method="post" action="{{route('saveCurrency')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Currency Code</label>
                        <div class="col-md-10">
                            <input id="currency_code" type="text" class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" value="{{ old('currency_code') }}"  autocomplete="currency_code" autofocus>
                            @error('currency_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Currency Name</label>
                        <div class="col-md-10">
                            <input id="currency_name" type="text" class="form-control @error('currency_name') is-invalid @enderror" name="currency_name" value="{{ old('currency_name') }}"  autocomplete="currency_name" autofocus>
                            @error('currency_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Currency') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

