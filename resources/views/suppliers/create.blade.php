@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h4 class="page-title">Create Creditor</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <form method="post" action="{{route('saveSupplier')}}">
                @csrf
                <div class="card-box mb-0">
                    <h3 class="card-title">Supplier Information</h3>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Trade Name</label>
                                {{$errors->first('name')}}
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                {{$errors->first('phone_number')}}
                                <input class="form-control" type="text" name="phone_number"
                                       value="{{ old('phone_number') }}">
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tax Code</label>
                                <input class="form-control" type="text" name="tax_number" value="{{ old('tax_number') }}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Taxable</label>
                                <select class="form-control" type="text" name="taxable"
                                       value="{{ old('taxable') }}">
                                    <option value="">Select Choice</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                {{$errors->first('address')}}
                                <textarea class="form-control" type="text" name="address" value="{{ old('address')}}"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-"></label>
                        <div class="col-md-12">
                            <button class="btn btn-success form-control"
                                    type="submit">{{ __('Create Supplier') }}</button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>

@endsection
