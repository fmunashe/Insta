@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h4 class="page-title">Create Requisition</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <form method="post" action="{{route('saveRequisition')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-box mb-0">
                    <h3 class="card-title">Requisition Expense Information</h3>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Select Creditor</label>
                        <div class="col-md-10">
                            <select class="form-control" name="creditor" id="creditor">
                                @foreach($creditors as $creditor)
                                    {{$errors->first('creditor')}}
                                    <option value="{{$creditor->id}}">{{$creditor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Vatable</label>
                        <div class="col-md-10">
                            {{$errors->first('Vatable')}}
                                <select class="form-control" name="vatable" id="vatable">
                                    <option value="1">yes</option>
                                    <option value="0">no</option>
                                </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Amount</label>
                        <div class="col-md-10">
                            {{$errors->first('amount')}}
                            <input class="form-control" type="number" name="amount" value="{{ old('amount') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Requisition Details</label>
                        <div class="col-md-10">
                            {{$errors->first('description')}}
                            <select class="form-control" type="text" name="description" value="{{ old('description') }}">
                              <option value="">Select Requisition Details</option>
                                <option value="Rent">Rent</option>
                                <option value="Debtors">Debtors</option>
                                <option value="Purchases">Purchases</option>
                                <option value="Salaries and Wages">Salaries and Wages</option>
                                <option value="Stationery">Stationery</option>
                                <option value="Telephone">Telephone</option>
                                <option value="Consultation">Consultation</option>
                                <option value="Water Bills">Water Bills</option>
                                <option value="Heating and Lighting">Heating and Lighting (Zesa)</option>
                                <option value="Internet">Internet</option>
                                <option value="Fuels and Oils">Fuels and Oils</option>
                                <option value="Staff Welfare">Staff Welfare</option>
                                <option value="Transport">Transport</option>
                                <option value="Licenses">Licenses</option>
                                <option value="Repairs and Maintenance">Repairs and Maintenance</option>
                                <option value="Research and Development">Research and Development</option>
                                <option value="Foreign Exchange Differences">Foreign Exchange Differences</option>
                                <option value="Bank Charges">Bank Charges</option>
                                <option value="Bank Interest">Bank Interest</option>
                                <option value="Loan Interest">Loan Interest</option>
                                <option value="Fines">Fines</option>
                                <option value="Travel and Subsistence">Travel and Subsistence</option>
                                <option value="Export Marketing Expenses">Export marketing Expenses</option>
                                <option value="Local marketing Expenses">Local marketing Expenses</option>
                                <option value="Other">Any Other Expenses</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-"></label>
                    <div class="col-md-12">
                        <button class="btn btn-success form-control"
                                type="submit">{{ __('Create Requisition') }}</button>
                    </div>
                </div>

        </form>
    </div>
    </div>

@endsection
