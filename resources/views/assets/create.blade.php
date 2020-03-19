@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Asset Registration
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </h4>
                <form method="post" action="{{route('saveAsset')}}">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box bg-light">
                                <fieldset>
                                    <legend>Asset Details</legend>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">asset number</label>
                                        <div class="col-md-4">
                                            <input id="name" type="number" class="form-control @error('asset_number') is-invalid @enderror" name="asset_number" value="{{ old('asset_number') }}"  autocomplete="asset_number" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label class="col-form-label col-md-2">asset name </label>
                                        <div class="col-md-4">
                                            <input id="name" type="text" class="form-control @error('asset_name') is-invalid @enderror" name="asset_name" value="{{ old('asset_name') }}"  autocomplete="asset_name" autofocus>
                                            @error('asset_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">asset location</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="text" class="form-control @error('asset_location') is-invalid @enderror" name="asset_location" value="{{ old('asset_location') }}"  autocomplete="asset_location" autofocus>
                                            @error('asset_location')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label class="col-form-label col-md-2">asset classification</label>
                                        <div class="col-md-4">
                                            <select id="asset_classification" type="text" class="form-control @error('asset_classification') is-invalid @enderror" name="asset_classification" value="{{ old('asset_classification') }}"  autocomplete="asset_classification" autofocus>
                                                <option value="">classification</option>

                                                <option value="computers">computers</option>
                                                <option value="motor vehicles">motor vehicles</option>
                                                <option value="Furniture and Fittings">Furniture and Fittings</option>
                                                <option value="Office Furniture">Office Furniture</option>
                                                <option value="Lease Improvements">Lease Improvements</option>
                                                <option value="Working Capital">Working Capital</option>
                                                <option value="Lease Hold Property">Lease Hold Property</option>
                                                <option value="Land">Land</option>
                                                <option value="Building and Improvements">Building and Improvements</option>
                                                <option value="Construction">Construction</option>
                                                <option value="Work in Progress">Work in Progress</option>
                                                <option value="Vehicles under Lease">Vehicles under Lease</option>


                                            </select>
                                            @error('dep_method')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-form-label col-md-2">date acquired</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="date" class="form-control @error('date_acquired') is-invalid @enderror" name="date_acquired" value="{{ old('date_acquired') }}"  autocomplete="date_acquired" autofocus>
                                            @error('date_acquired')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <label class="col-form-label col-md-2">depreciation method</label>

                                        <div class="col-md-4">
                                            <select id="dep_method" type="text" class="form-control @error('dep_method') is-invalid @enderror" name="dep_method" value="{{ old('dep_method') }}"  autocomplete="dep_method" autofocus>
                                                <option value="">depreciation method</option>

                                                <option value="0">straight line</option>
                                                <option value="1">reducing method</option>


                                            </select>
                                            @error('dep_method')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-form-label col-md-2">span</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="number" class="form-control @error('span') is-invalid @enderror" name="span" value="{{ old('span') }}"  autocomplete="span" autofocus>
                                            @error('span')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label class="col-form-label col-md-2">depreciation rate</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="number" class="form-control @error('dep_rate') is-invalid @enderror" name="dep_rate" value="{{ old('dep_rate') }}"  autocomplete="dep_rate" autofocus>
                                            @error('dep_rate')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                    </div>



                                    <div class="form-group row">

                                        <label class="col-form-label col-md-2">narration</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="text" class="form-control @error('narration') is-invalid @enderror" name="narration" value="{{ old('narration') }}"  autocomplete="narration" autofocus>
                                            @error('narration')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <label class="col-form-label col-md-2">invoice number</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="number" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}"  autocomplete="invoice_number" autofocus>
                                            @error('invoice_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-form-label col-md-2">invoice details</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="text" class="form-control @error('invoice_details') is-invalid @enderror" name="invoice_details" value="{{ old('invoice_details') }}"  autocomplete="invoice_details" autofocus>
                                            @error('invoice_details')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <label class="col-form-label col-md-2">purchase price</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="number" class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price" value="{{ old('purchase_price') }}"  autocomplete="purchase_price" autofocus>
                                            @error('purchase_price')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>


                                    </div>




                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">transport cost</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="number" class="form-control @error('transport_cost') is-invalid @enderror" name="transport_cost" value="{{ old('transport_cost') }}"  autocomplete="transport_cost" autofocus>
                                            @error('transport_cost')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label class="col-form-label col-md-2">other cost</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="number" class="form-control @error('other_cost') is-invalid @enderror" name="other_cost" value="{{ old('other_cost') }}"  autocomplete="other_cost" autofocus>
                                            @error('other_cost')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>


                                    </div>






                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Create Asset') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript">
        function removeProductRow(row = null) {
            if(row)
            {
                $("#row"+row).remove();
                subAmount();
            }
            else
            {
                alert('error! Refresh the page again');
            }
        }

        function subAmount() {

            var tableLength=$("#productTable tbody tr").length;
            var totalSubAmount=0;
            for(x=0;x<tableLength;x++){
                var tr=$("#productTable tbody tr")[x];
                var count=$(tr).attr('id');
                count=count.substring(3);
                totalSubAmount=Number(totalSubAmount)+Number($("#ItemP"+count).val())
            }
            totalSubAmount=totalSubAmount.toFixed(2);
            document.getElementById('Amount').value=totalSubAmount;
        }

        function addRow() {
            $("#addRowBtn").button("loading");
            var tableLength = $("#productTable tbody tr").length;
            var tableRow;
            var arrayNumber;
            var count;
            if(tableLength > 0) {
                tableRow = $("#productTable tbody tr:last").attr('id');
                arrayNumber = $("#productTable tbody tr:last").attr('class');
                count = tableRow.substring(3);
                count = Number(count) + 1;
                arrayNumber = Number(arrayNumber) + 1;
            } else {
                // no table row
                count = 1;
                arrayNumber = 0;
            }
            $.ajax({
                url: '',
                type: 'post',
                dataType: 'json',
                error:function(response) {
                    $("#addRowBtn").button("reset");

                    var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
                        '<td>'+
                        '<input type="text" name="ItemDescription[]" id="ItemDesc'+count+'" class="form-control" required="required"/>'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" min="0" step="0.01" name="ItemPrice[]" id="ItemP'+count+'" class="form-control" required="required" onkeyup="subAmount()" />'+
                        '</td>'+
                        '<td>'+
                        '<button class="btn btn-success" onclick="addRow()" type="button"><i class="fa fa-plus"></i></button>'+
                        '&nbsp'+
                        '<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-trash"></i></button>'+
                        '</td>'+
                        '</tr>';
                    if(tableLength > 0) {
                        $("#productTable tbody tr:last").after(tr);
                    } else {
                        $("#productTable tbody").append(tr);
                    }

                } // /success
            });	// get the product data
        } // /add row

    </script>
@endsection
