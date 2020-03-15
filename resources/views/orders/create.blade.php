@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Upload Orders</h4>
                <form method="post" action="{{route('saveOrders')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Choose file</label>
                        <div class="col-md-10">
                            <input id="orders" type="file" class="form-control @error('import_file') is-invalid @enderror" name="import_file" value="{{ old('import_file') }}"  autocomplete="orders" autofocus>
                            @error('import_file')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('upload file') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
