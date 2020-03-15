@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Product Category</h4>
                <form method="post" action="{{route('saveCategory')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Category Name</label>
                        <div class="col-md-10">
                            <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}"  autocomplete="category_name" autofocus>
                            @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Category') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

