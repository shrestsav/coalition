@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Coalition Interview Solution') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content">
                        <form action="{{route('storeItems')}}" method="post">
                            @csrf
                            <div class="mb-3">
                              <label for="product_name" class="form-label">Product Name</label>
                              <input name="product_name" type="text" class="form-control" id="product_name" aria-describedby="productHelp">
                              <div id="productHelp" class="form-text">Enter Product Name</div>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input name="quantity" type="number" class="form-control" id="quantity" aria-describedby="quantityHelp">
                                <div id="quantityHelp" class="form-text">Enter Quantity in Stock</div>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input name="price" type="number" class="form-control" id="price" aria-describedby="priceHelp">
                                <div id="priceHelp" class="form-text">Enter Price per Item</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity in Stock</th>
                                <th scope="col">Price Per Item</th>
                                <th scope="col">Datetime submitted</th>
                                <th scope="col">Total value number</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$item['product_name']}}</td>
                                        <td>{{$item['quantity_in_stock']}}</td>
                                        <td>{{$item['price_per_item']}}</td>
                                        <td>{{$item['date_submitted']}}</td>
                                        <td>{{$item['total_value_number']}}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Sum Total</td>
                                        <td>{{$totalSum}}</td>
                                    </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
