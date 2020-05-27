@extends('layouts.store')

@section('store_content')

@push('scripts')
    <script>
      // functionality to copy text from inviteCode to clipboard

// trigger copy event on click
$('#copy').on('click', function(event) {
  console.log(event);
  copyToClipboard(event);
});

// event handler
function copyToClipboard(e) {
  // alert('this function was triggered');
  // find target element
  var
    t = e.target, 
    c = t.dataset.copytarget,
    inp = (c ? document.querySelector(c) : null);
  console.log(inp);
  // check if input element exist and if it's selectable
  if (inp && inp.select) {
    // select text
    inp.select();
    try {
      // copy text
      document.execCommand('copy');
      inp.blur();

      // copied animation
      t.classList.add('copied');
      setTimeout(function() {
        t.classList.remove('copied');
      }, 1500);
    } catch (err) {
      //fallback in case exexCommand doesnt work
      alert('please press Ctrl/Cmd+C to copy');
    }

  }

}
      </script>
@endpush
<div class="row  m-lg-1">
  <div class="col-12 text-right p-3">
    <a  class="btn btn-default theme-btn" href="{{route('product.create',['store'=>$store,'product_type'=>'empty'])}}" role="button">Add product <i data-feather="plus"></i></a>
  </div>
</div>


<section class="featured-products m-lg-1">
<div class="section-title ml-lg-4">
  <div class="h3">Featured products</div>
</div><div class="section__content">
  @if ($store->featuredProducts!=null)
@if ($store->featuredProducts->count() > 0)
<div class="row m-lg-0 ">
  @foreach ($store->featuredProducts->slice(0,4) as $item)
  <div class="col-12 col-md-6">
  <div class="card mt-2">
    <img class="card-img-top img-fluid" src="{{$item->findProduct($item->product_id)->getImage('')}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$item->findProduct($item->product_id)->title}}</h5>
      <p class="card-text">$ {{$item->findProduct($item->product_id)->price}}</p>
    <p class="card-text">AD type: {{$item->type}}</p>
      <div class="d-flex flex-row  mb-3">
        <div class="bd-highlight"><a href="{{route('remove.featured',['id'=>$item->findProduct($item->product_id)->id])}}" class="text-dark"><i class="feather-16 feather-inline" data-feather="trash-2"></i> Remove</a></div>
      </div>
      
    </div>
  </div>
  </div>
  @endforeach      
</div>


@else
<div class="d-flex flex-lg-row flex-column">

  <div class="p-2 bd-highlight">
  @if ($store->products->count()==0)
       <div class="card text-dark shadow-none bg-white p-5 text-center" style="border:3px dashed rgb(228,230,234)">
         <div class="card-body">
           <h4 class="card-title h5">No products available</h4>
           <p class="card-text"> 
            <i class="fa fa-plus" aria-hidden="true"></i>
             <a href="{{route('product.create',['store'=>$store,'product_type'=>'empty'])}}"> Add products</a>
            </p>
         </div>
       </div>
  @endif
  </div>
  <div class="p-2 bd-highlight">
  <div class="card text-dark shadow-none bg-white p-5 text-center" style="border:3px dashed rgb(228,230,234)">
  <div class="card-body">
    <h2 class="card-title h5"> No featured products</h2>
    <p class="card-text"> <a href="{{route('store.inventory',['store'=>$store])}}"> <i class="fa fa-plus" aria-hidden="true"></i> Add a product</a></p>
  </div>
  </div>
</div>

</div>
  @endif
  @endif
 
</div>
</section>




@if (!is_null($store->products) && $store->products->count() >0)
<section class="product-section m-lg-4 ">
  <div class="row">
    <div class="col-12 col-xl-4 col-md-6 mt-lg-0 mt-2">
    <div class="card shadow-sm ">
      <div class="card-header bg-transparent border-0">
        <div class="h3">Last product performance</h3>
      </div>
      </div>
     

      <div class="product">
        <div class="wrapper-latest rounded-0 m-0 w-100 no-animation" style="background-image:url({{$store->products->last()->getImage('')}})">
          <div class="card-img-overlay text-white d-flex justify-content-start align-items-end overlay-dark">
            <p>{{$store->products->last()->title}}</p>
          </div>
      </div>
      </div>

      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0">
            Views
            <span>{{views($store->products->last())->unique()->count()}}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0">
            User request
            <span>0</span>
          </li>

          <li class="list-group-item d-flex justify-content-between align-items-center border-0">
           <h4>View product analytics</h3>
          </li>
         
        </ul>
      </div>

    </div>
    </div>

    <div class="col-12 col-xl-4 col-md-6">
    <div class="card shadow-sm h-auto mt-lg-0 mt-2">
      <div class="card-header bg-transparent border-0">
      <div class="h3">Notifications<small> <span class="badge badge-danger">{{$store->unReadNotifications->count() ? $store->unReadNotifications->count():''}}</span></small></div>
     </div>
     <div class="card-body">
       @if ($store->unReadNotifications->count() > 0)
       <div class="list-group">
         <a href="{{route('store.notifications')}}" class="list-group-item list-group-item-action flex-column align-items-start">
           <div class="d-flex w-100 justify-content-between">
           <h5 class="mb-1">{{$store->unReadNotifications->count() > 1 ? 'You have '.$store->unReadNotifications->count().' product notifications':'You have '.$store->unReadNotifications->count().' product notification' }}</h5>
             <small></small>
           </div>
         </a>

         @if (views($store)->unique()->count() > 0)
         <a href="{{route('store.analytics',['store'=>$store,'period'=>28])}}" class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">Your store got {{views($store)->unique()->count()}} views</h5>
            <small></small>
          </div>
          <p class="mb-1">See store analytics</p>
        </a>
         @endif
 
      </div>
       @endif
     </div>
    </div>
    </div>

    <div class="col-12 col-xl-4 col-md-6 mt-lg-0 mt-2">
    <div class="card shadow-sm">
     <div class="card-header bg-transparent border-0">
       <div class="h3">Store summary</h3>
     </div>
    </div>
    <div class="card-body">
      <li class="list-group-item d-flex justify-content-between align-items-center border-0">
        <div class="input-group mb-3">
          <input type="text" id="link" class="form-control" readonly value="{{route('store.index',['store'=>$store])}}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
          <div class="input-group-append" id="copy">
            <span class="input-group-text" id="basic-addon2"><i data-feather="copy" class=" text-dark" data-copytarget="#link"></i></span>
          </div>
        </div>
      </li>
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
          Current subscribers
          <span><h3>0</h3></span>
        </li>
      </ul>
        <div class="dropdown-divider"></div>
        <h5 class="ml-3">Summary</h5>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0">
            Number products
            <span>{{$store->products->count() ?? '0'}}<span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0">
            Views(Past 28 days)
            <span>{{$store->getViewsForPastdays(28)}}<span>
          </li>
        </ul>
        <div class="dropdown-divider"></div>

        <h5 class="ml-3 font-weight-bold">Top products</h5>
        <ul class="list-group">
          @foreach ($store->products as $product)

          <li class="list-group-item d-flex justify-content-between align-items-center border-0">
           <a href="{{route('product.view',['product'=>$product])}}">{{$product->title}}</a>
           
          </li>
          @endforeach
        
        </ul>
    </div>
    </div>
  </div>

  </div>
</section>
@endif
  
        
           
   
  

@endsection
   