@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
<style>
    table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .9em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
    </style>
@endpush

@push('scripts')
<script>
    
    function removeAll(id){
        $.ajax({
            url:'cart-delete/'+id,
            type:'GET',
            success:function(resp){
                console.log(resp);
                Toastify({
                text: "Cart updated!",
                duration: 3000, 
                // destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: 'left', // `left`, `center` or `right`
                backgroundColor: "rgb(142,199,61)",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                onClick: function(){} // Callback after click
            }).showToast();
            location.reload()
            }
        });
    }

    function removeOne(id){
        $.ajax({
            url:'cart-delete-one/'+id,
            type:'GET',
            success:function(resp){
                console.log(resp);
                Toastify({
                text: "Cart updated!",
                duration: 3000, 
                // destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: 'left', // `left`, `center` or `right`
                backgroundColor: "rgb(142,199,61)",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                onClick: function(){} // Callback after click
            }).showToast();
            location.reload()
            }
        });
    }

function requestItem(id){
      $.ajax({
            url:'request-item/'+id,
            type:'GET',
            success:function(resp){
                $("#tr"+id).remove();
                Toastify({
                        text: resp,
                        duration: 3000, 
                        // destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "rgb(142,199,61)",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function(){} // Callback after click
                      }).showToast();
            }
        });}
</script>
@endpush

@section('content')
    <div class="container">

        @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
            <strong>{{session()->get('message')}}</strong>
            </div>
        @endif
       
                @if(Session::has('cart') && sizeof(Session::get('cart')->items) >0)
        
                <div class="row">
                    <div class="col-12">
                    
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col"  class="w-25">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    @auth
                                    <th scope="col">Store info</th>
                                    @endauth
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                      
                        <tbody>
                            @foreach ($products as $product)
                        <tr id="tr{{$product['item']['id']}}">
                            <td data-label="Image">
                                <img class="img-fluid rounded" src="{{$product['item']->getImage("medium")}}" alt="item1" />
                            </td>
                            <td data-label="Title">
                                <h2 class="h5">{{$product['item']['title']}}</h2>
                            </td>
                            <td data-label="Price">
                                @convert($product['item']['price'])
                            </td>
                            <td data-label="Quantity">
                                {{$product['qty']}}
                            </td>
                            <td data-label="Price">
                                @convert($product['item']['price'] * $product['qty'])

                            </td>
                            @auth

                            <td data-label="Store info">
                               <a href="{{route('store.index',['store'=>$product['item']['store']])}}"> {{$product['item']['store']['name']}}</a>
                            </td>
                            @endauth
                            <td data-label="Action">
                                <div class="d-flex flex-lg-row flex-column">
                                <div class="dropdown open">
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                Action
                                            </button>
                             

                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item" role="button" onclick="requestItem('{{$product['item']['id']}}')" href="javascript:;">Request</a>
                                    <a class="dropdown-item" role="button" href="javascript:;"  onclick="removeOne({{$product['item']['id']}})">Remove one</a>
                                        <a class="dropdown-item" role="button" href="javascript:;"  onclick="removeAll({{$product['item']['id']}})">Remove all</a>
                                    </div>
                                </div>
                                </div>
                            </td>
                            </tr>
                            
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex flex-column bd-highlight mb-3 justify-content-end">
                    {{-- <div class="p-2 bd-highlight">
                        <div class="d-flex flex-row bd-highlight mb-3">
                            <div class="p-2  bd-highlight"><h1 class="h3">Cart total</h1></div>
                        <div class="p-2  bd-highlight"><h1 class="h3">@convert($totalPrice)</h1></div>
                        </div>
                    </div> --}}

                    <div class="p-2 bd-highlight">
                        @auth
                        <form action="{{route('products.request')}}" method="POST">
                            @csrf
                        <button type="submit" class="btn btn-primary btn-lg border-0" style="background-color: #8EC73D !important">Request products</button>

                        </form>
                        @endauth
                        @guest
                            <a name="" id="" class="btn btn-primary btn-lg border-0" style="background-color: #8EC73D !important" href="{{route('login')}}" role="button">Please login to request products</a>
                        @endguest
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
@section('footer')
@include('layouts.footer')
@endsection
