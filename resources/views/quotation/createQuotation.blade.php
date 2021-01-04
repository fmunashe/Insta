@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Customer Quotation
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </h4>
                <form method="post" action="{{route('saveQuotation')}}">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box bg-light">
                                <fieldset>
                                    <legend>Customer Details</legend>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Customer Name</label>
                                        <div class="col-md-4">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label class="col-form-label col-md-2">Email Address</label>
                                        <div class="col-md-4">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Phone Number</label>
                                        <div class="col-md-4">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label class="col-form-label col-md-2">Physical Address</label>
                                        <div class="col-md-4">
                                        <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  autocomplete="address" autofocus>
                                        </textarea>
                                            @error('address')
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
                        <label class="col-form-label col-md-2">Quotation Description</label>
                        <div class="col-md-10">
                            <input id="Description" type="text" class="form-control @error('Description') is-invalid @enderror" name="Description" value="{{ old('Description') }}"  autocomplete="Description" autofocus>
                            @error('Description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Currency</label>
                        <div class="col-md-4">
                            <select id="currency" type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency') }}"  autocomplete="currency" autofocus onchange="subAmount()" required>
                                <option value="">Select Currency</option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->currency_code}}">{{$currency->currency_code}}</option>
                                @endforeach
                            </select>
                            @error('currency')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <label class="col-form-label col-md-2">Rate</label>
                        <div class="col-md-4">
                            <input id="rate" type="text" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate') }}"  autocomplete="rate" autofocus>
                            @error('rate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-label">Quotation Items</div>
                    <div class="table-responsive">
                        <table class="table" id="productTable">
                            <thead>
                            <tr>
                                <th style="width: 50%">Item Description</th>
                                <th style="width: 20%">Quantity</th>
                                <th style="width: 20%">Price</th>
                                <th style="width: 10%">Row Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $arrayNumber = 0;
                            for($x = 1; $x < 4; $x++) { ?>
                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                <td>
                                    <select name="ItemDescription[]" id="ItemDesc<?php echo $x; ?>" class="form-control"
                                            required='required'>
                                        <option value="">Select Item</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->product_code}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" min="0" step="0.01" name="ItemQuantity[]" id="ItemQ<?php echo $x; ?>" class="form-control" required='required' onkeyup="subAmount()"></td>
                                <td><input type="number" min="0" step="0.01" name="ItemPrice[]" id="ItemP<?php echo $x; ?>" class="form-control" required='required' onkeyup="subAmount()"></td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn"><i class="fa fa-plus"></i></button> &nbsp;
                                    <button type="button" class="btn btn-danger removeProductRowBtn" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php
                            $arrayNumber++;
                            } // /for
                            ?>
                            </tbody></table>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Total Quotation Amount</label>
                        <div class="col-md-10">
                            <input id="Amount" type="number" min="0" step="0.01" class="form-control @error('Amount') is-invalid @enderror" name="Amount" value="{{ old('Amount') }}"  autocomplete="Amount" autofocus>
                            @error('Amount')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit" onmouseover="subAmount()" onclick="subAmount()">{{ __('Create Customer Quotation') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript">
        $(document).ready(function(){
            // currency Change
            $('#currency').change(function(){
                var id = $(this).val();
                // AJAX request
                $.ajax({
                    url: 'searchCurrency/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        $("#rate").val(response.rate);
                    }
                });
            });
        });

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
                totalSubAmount=Number(totalSubAmount)+(Number($("#ItemP"+count).val())*Number($("#ItemQ"+count).val())*Number($("#rate").val()))
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
                        '<td>' +
                        '<select name="ItemDescription[]" id="ItemDesc' + count + '" class="form-control" required="required">'+
                        '<option value="">Select Item</option> '+
                        @foreach($products as $product)
                            '<option value="{{$product->product_code}}">{{$product->product_name}}</option> '+
                        @endforeach
                            '</select>'+
                        '</td>' +
                        '<td>'+
                        '<input type="number" min="0" step="0.01" name="ItemQuantity[]" id="ItemQ'+count+'" class="form-control" required="required" onkeyup="subAmount()" />'+
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
