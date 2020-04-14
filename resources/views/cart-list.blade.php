@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endpush
@section('content')
    <div class="container">

       
                @if(Session::has('cart'))
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered cart-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                      
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                            <td class="w-25">
                                <img class="img-fluid" src="{{$product['item']->getImage("thumbnail_smaller")}}" alt="item1" />
                            </td>
                            <td>
                                <h2 class="h5">{{$product['item']['title']}}</h2>
                            </td>
                            <td>
                                {{$product['item']['price']}}
                            </td>
                            <td>
                                {{$product['qty']}}
                            </td>
                            <td>
                                {{$product['item']['price'] * $product['qty']}}

                            </td>
                            <td>
                                <a class="fa fa-trash" href="#" aria-hidden="true"></a>
                            </td>
                            </tr>
                            
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex flex-column bd-highlight mb-3 justify-content-end">
                    <div class="p-2 bd-highlight">
                        <div class="d-flex flex-row bd-highlight mb-3">
                            <div class="p-2  bd-highlight"><h1 class="h3">Cart total</h1></div>
                            <div class="p-2  bd-highlight"><h1 class="h3">$ {{$totalPrice}}</h1></div>
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a class="btn btn-lg baz-button">Request items</a>
                    </div>
                   
                  </div>
            </div>
        </div>



        @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        Cart Empty
                    </div>
                </div>
            </div>
        </div>

                @endif
         

    </div>
@endsection