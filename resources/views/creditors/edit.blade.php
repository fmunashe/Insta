@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h4 class="page-title">Edit Creditor</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <form method="post" action="/updateCreditor/{{$creditor->id}}" >
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="card-box mb-0">
                    <h3 class="card-title">Creditor Information</h3>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                {{$errors->first('name')}}
                                <input class="form-control" type="text" name="name" value="{{ old('name') ?? $creditor->name }}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                {{$errors->first('phone_number')}}
                                <input class="form-control" type="text" name="phone_number" value="{{ old('phone_number') ?? $creditor->phone_number }}">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                {{$errors->first('address')}}
                                <textarea class="form-control" type="text" name="address" value="{{ old('address') ?? $creditor->address }}">{{$creditor->address }}
                                </textarea>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-"></label>
                        <div class="col-md-12">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Creditor') }}</button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
