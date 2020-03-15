@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Exchange Rate Registration</h4>
                <form method="post" action="{{route('saveRate')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Currency Code</label>
                        <div class="col-md-10">
                            <select id="currency_code" type="text" class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" value="{{ old('currency_code') }}"  autocomplete="currency_code" autofocus>
                           <option value="">Select Currency Mode</option>
                               @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->currency_code}}</option>
                                @endforeach
                            </select>
                            @error('currency_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Rate</label>
                        <div class="col-md-10">
                            <input id="rate" type="number" min="0" step="0.01" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate') }}"  autocomplete="rate" autofocus>
                            @error('rate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('New Exchange Rate') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

