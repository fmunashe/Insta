@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h4 class="page-title">Revenue Income Entry</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <form method="post" action="{{route('postRevenue')}}">
                @csrf
                <div class="card-box mb-0">
                    <h3 class="card-title">Revenue Income Information</h3>
                      <div class="form-group row">
                        <label class="col-form-label col-md-2">Revenue Details</label>
                        <div class="col-md-10">
                            {{$errors->first('name')}}
                            <select class="form-control" type="text" name="name" value="{{ old('name') }}">
                                <option value="">Select Revenue Details</option>
                                <option value="Capital">Capital</option>
                                <option value="Bank Loan">Bank Loan</option>
                                <option value="Creditors">Creditors</option>
                                <option value="Other">Other Sources</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Description</label>
                        <div class="col-md-10">
                            {{$errors->first('description')}}
                            <textarea class="form-control" name="description" value="{{ old('description') }}"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Amount</label>
                        <div class="col-md-10">
                            {{$errors->first('amount')}}
                            <input class="form-control" type="number" name="amount" value="{{ old('amount') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-"></label>
                    <div class="col-md-12">
                        <button class="btn btn-success form-control"
                                type="submit">{{ __('Post Revenue Income') }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
