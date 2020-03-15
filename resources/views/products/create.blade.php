@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Product</h4>
                <form method="post" action="{{route('saveProduct')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Product Category</label>
                        <div class="col-md-10">
                            <select id="category_id" type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') }}"  autocomplete="category_id" autofocus>
                           <option value="">Product Category</option>
                               @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                               @endforeach
                            </select>
                                @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Product Code</label>
                        <div class="col-md-10">
                            <input id="product_code" type="text" class="form-control @error('product_code') is-invalid @enderror" name="product_code" value="{{ old('product_code') }}"  autocomplete="product_name" autofocus>
                            @error('product_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Product Name</label>
                        <div class="col-md-10">
                            <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"  autocomplete="product_name" autofocus>
                            @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Product Description</label>
                        <div class="col-md-10">
                            <textarea id="product_description" type="text" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ old('product_description') }}"  autocomplete="product_description" autofocus>
                            </textarea>
                                @error('product_description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Price</label>
                        <div class="col-md-10">
                            <input id="price" type="number" min="0" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Quantity</label>
                        <div class="col-md-10">
                            <input id="quantity" type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}"  autocomplete="quantity" autofocus>
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Unit of Measure</label>
                        <div class="col-md-10">
                            <select id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}"  autocomplete="unit" autofocus>
                                <option value="">Unit of Measure</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->unit_of_measure}}">{{$unit->unit_of_measure}}</option>
                                @endforeach
                            </select>
                            @error('unit')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Product') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

