@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h4 class="page-title">Update Product Price</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <form method="post" action="/updateProduct/{{$product->id}}" >
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <table id="client" class="table table-striped table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Code</th>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Old Price</th>
                                    <th>New Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->ProductCategory->category_name}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_description}}</td>
                                        <td>{{$product->unit}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->price}}</td>

                                        <td>

                                            <input class="form-control" type="text" name="price" value="{{ old('price') ?? $product->price }}"></td>
                                        {{$errors->first('price')}}
                                        <td>
                                            <button class="btn btn-success form-control" type="submit">{{ __('Update') }}</button>

                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
