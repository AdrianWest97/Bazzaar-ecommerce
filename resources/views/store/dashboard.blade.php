@extends('layouts.store',['store'=>$data])

@section('store_content')
<div class="container">

  <div class="row m-0">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          @if ($data['store']->featuredProducts)
            <h1 class="h5">Featured products</h1>
           <table class="table table-sm table-bordered table-condensed cart-table">
             <thead>
               <tr>
                 <th>Image</th>
                 <th>Product name</th>
                 <th>Offer type</th>
                 <th>Duration</th>
                 <th>Start date</th>
                 <th>End date</th>
                 <th></th>
               </tr>
             </thead>
             <tbody>
              @foreach ($data['store']->featuredProducts as $item)
               <tr>
                 <td scope="row"><img src={{$item->findProduct($item->product_id)->getImage('thumbnail_smaller')}} class="img-fluid"></td>
                 <td>{{$item->findProduct($item->product_id)->title}}</td>
                 <td>{{$item->type}}</td>
                 <td>7 days</td>
                 <td>{{date('M d, Y', strtotime($item->start))}}</td>
                 <td>{{date('M d, Y', strtotime($item->end))}}</td>
                 <td>Delete</td>
               </tr>
               @endforeach
             </tbody>
           </table>
                  
              </ul>
          @endif
        </div>
      </div>
    </div>
  </div>


       <div class="row m-0">
          <div class="col-12">
        
           @if (!is_null($data['store']->products) && count($data['store']->products) >0)
           <div class="row">
           @foreach ($data['store']->products as $item)
              
           @include('layouts.product',['item'=>$item,'show'=>true])

           @endforeach
           </div>
           @else
         
           <div class="row justify-content-center m-5">
              <div class="col-3">
            <h4 class="card-title">No products available</h4>
            <a name="" id="" class="baz-button text-center" href="{{route('product.create',['store'=>$data['store'],'product_type'=>'empty'])}}" role="button">Add product</a>
              </div>
         </div>

   

           @endif
           <br>

          </div>
       </div>
  </div>

@endsection
   