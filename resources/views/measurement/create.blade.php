@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Unit Of Measure</h4>
                <form method="post" action="{{route('saveUnit')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Unit Of Measure</label>
                        <div class="col-md-10">
                            <input id="unit_of_measure" type="text" class="form-control @error('unit_of_measure') is-invalid @enderror" name="unit_of_measure" value="{{ old('unit_of_measure') }}"  autocomplete="unit_of_measure" autofocus>
                            @error('unit_of_measure')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Unit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

