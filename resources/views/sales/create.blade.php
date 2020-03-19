@extends('layouts.app')
@section('styles')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .search-input {
            box-shadow: none;
            padding: 0.469rem 0.75rem;
            border-color: transparent;
            font-size: 14px;
            min-height: 40px;
        }
        .p-20 {
            padding: 20px;
        }
        .p-l-20 {
            padding-left: 20px;
        }
        .p-r-20 {
            padding-left: 20px;
        }
        .tx-13 {
            font-size: 13px;
        }
    </style>

@endsection
@section('content')
    <div style="height: calc(100vh - 130px)" class="card-box row p-0" id="app">
        <div style="height: calc(100vh - 130px);position: relative" class="col-lg-7 border-right p-0">
            <div class="border-bottom d-flex align-items-center" style="position: absolute;height: 55px;padding: 0 20px;top: 0;right: 0;left: 0;">
                <label>Currency</label>
                <select id="CustomerId" type="text" style="max-width: 200px" v-model="rate"
                        class="form-control @error('currency') is-invalid @enderror mr-auto" name="currency"
                        value="{{ old('currency') }}" autocomplete="currency" autofocus required>
                    <option value=""> Select Currency</option>
                    @foreach($currencies as $currency)
                        <option :value="{{$currency->rate}}">{{$currency->currency_code}}</option>
                    @endforeach
                </select>
                <span class="mr-3">Rate : @{{ rate.rate }}</span>
                <button @click="create" class="btn btn-success btn-rounded">Create</button>
            </div>
            <div style="height: calc(100vh - 130px - 55px - 55px);overflow-y: scroll;position: absolute;top: 55px;bottom: 55px;right: 0;left: 0">
                <table class="table table-hover tx-13">
                    <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th class="text-center">Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="`product-${index}-${product.id}`" v-for="( product , index ) in products">
                        <td class="text-primary">#@{{ product.id }}</td>
                        <td>@{{ product.product_name }}</td>
                        <td>@{{ product.price * rate.rate }}</td>
                        <td class="text-center">
                            <button @click="product['number']--" v-if="product.number > 1" class="btn btn-sm btn-danger mr-2 font-18">-</button>
                                    @{{ product.number }}
                            <button @click="product['number']++" v-if="product.number < product.quantity" class="btn btn-sm btn-success ml-2 font-18">+</button>
                        </td>
                        <td>@{{ product.number * product.price * rate.rate }}</td>
                        <td>
                            <a @click.prevent="remove(index)" href="">
                                <i class="fa fa-times-circle fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="border-top d-flex align-items-center" style="position:absolute;bottom: 0;height: 55px;right: 0;left: 0;padding: 0 20px">
                <span class="mr-auto">Total</span>
                <span class="font-weight-bold font-18">@{{ total }}</span>
            </div>

        </div>
        <div style="height: calc(100vh - 130px)" class="col-lg-5 p-0">
            <div v-if="searchMode" style="height: 55px;padding: 0 20px;" class="d-flex align-items-center border-bottom">
                <span class="mr-1 border-right pr-3 py-2">Search</span>
                <input v-model="search" class="flex-fill search-input" type="text">
                <a @click.prevent="searchMode = false" href="">
                    <i class="fa fa-times-circle fa-2x"></i>
                </a>
            </div>
            <table v-if="searchMode" class="table table-hover tx-13">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <tr @click="fetchFromTable(product.product_code)" :key="`list-${index}-${product.id}`" v-for="(product , index ) in listProducts" style="cursor: pointer">
                    <td class="text-primary">#@{{ product.id }}</td>
                    <td>@{{ product.product_name }}</td>
                    <td>@{{ product.product_code }}</td>
                    <td>@{{ product.quantity }}</td>
                    <td>@{{ product.price * rate.rate }}</td>
                </tr>
                </tbody>
            </table>
            <div v-if="!searchMode" class="p-5">
                <h4 class="text-center">New Sales Invoice</h4>
                <div class="mt-5 text-center">
                    <div class="text-center mb-3">Product Code</div>
                    <input style="height: 45px" v-model="code" type="text" class="form-control text-center p-4" placeholder="">
                    <div class="text-danger mt-1" v-text="enterProductError"></div>
                    <button @click="fetchProduct" class="btn btn-success btn-sm mt-3">Submit</button>
                </div>
                <h4 class="mt-3 text-center">OR</h4>
                <a @click.prevent="searchMode = true" href="#" class="mt-3 text-center border p-3 d-block text-muted">
                    Click to Search
                </a>
            </div>

        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@9.js') }}"></script>
    <script>

        //  sweet alert

        window.swal = Swal;

        // Axios

        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        window.axios.defaults.headers.common['Accept'] = 'application/json';
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        } else {
            console.error('CSRF token not found , this is required for this web application');
        }

        var app = new Vue({
            el: '#app',
            data: {
                head: 'Create Sale',
                searchMode : false,
                loading : false,
                code : '',
                products : [],
                enterProductError : '',
                search : '',
                listProducts : [],
                rate : {
                    rate : 1
                },
            },
            mounted :  function()
            {
                this.fetchProducts();
            },
            computed : {
                total : function () {
                    return this.products.reduce(function (a, b) {
                        return b['number'] == null ? a : a + b['number'] * b['price'];
                    }, 0) * this.rate.rate;
                }
            },
            watch : {
                search : function (newValue , oldValue ) {
                    this.fetchProducts();
                }
            },
            methods : {
                create : function(){
                    window.axios.post('/saveSale' , {
                        products : this.products,
                        total : this.total,
                        rate:this.rate
                    }).then((response) => {
                        this.products = [];
                        this.fetchProducts();
                        window.swal.fire(
                            'Sale recorded',
                            'click ok to close',
                            'success'
                        );
                    console.log(response.message);
                    });
                },
                remove : function(index){
                    this.products.splice(index, 1);
                },
                fetchProducts : function(){
                    window.axios.get(`/products/search?search=${this.search}`).then((response) => {
                        this.listProducts = response.data;
                    });
                },
                addProduct : function(product){
                    product['number'] = 1;
                    this.products.push(product);
                },
                fetchFromTable : function(c){
                  this.code = c;
                  this.fetchProduct();
                },
                fetchProduct : function () {
                    this.enterProductError = '';
                    window.axios.get(`/products/${this.code}/view`).then((response) => {

                        if(response.data)
                        {
                            this.addProduct(response.data);
                            return;
                        }

                        this.enterProductError = 'Product not found';

                    });
                }
            }
        });

    </script>

@endsection
