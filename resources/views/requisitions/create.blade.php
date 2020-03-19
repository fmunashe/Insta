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
                            <h3 class="card-title">Requisition Information</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="position_id">Creditor</label>
                                    <br>
                                    <label>
                                        <select class="form-control" name="creditor" id="creditor">
                                            @foreach($creditors as $creditor)

                                                {{$errors->first('creditor')}}
                                                <option value="{{$creditor->id}}">{{$creditor->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>

                                </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        {{$errors->first('description')}}
                                        <input class="form-control" type="text" name="description" value="{{ old('description') }}">
                                    </div>

                                </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="gender">Vatable</label>
                                    {{$errors->first('Vatable')}}
                                    <br>
                                    <label>
                                        <select class="form-control" name="vatable" id="vatable">
                                            <option value="1">yes</option>
                                            <option value="0">no</option>
                                        </select>
                                    </label>

                                </div>
                            </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Amount </label>
                                        {{$errors->first('amount')}}
                                        <input class="form-control" type="number" name="amount" value="{{ old('amount') }}">
                                    </div>

                                </div>



</div>



                            <div class="form-group row">
                                <label class="col-form-label col-md-"></label>
                                <div class="col-md-12">
                                    <button class="btn btn-success form-control" type="submit">{{ __('Create Requisition') }}</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

@endsection
