
@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script>
$("#featured-courses").flickity({
  wrapAround: true,
  pageDots: false,
  initialIndex: 1,
  accessibility: true, //true by default
  autoPlay: false // advance cells every 3 seconds
});

function goDoSomething(identifier) {
  alert("data-id:" + $(identifier).data('paragraph'));
}



    </script>


<style>
    @import url(https://fonts.googleapis.com/css?family=Oswald:400,700);

    
    .carousel-cell {
        width: 66%;
  height: auto;
  margin-right: 30px;
  background: transparent;
  border-radius: 5px;
  counter-increment: carousel-cell;
  widows: 300px;
}

.carousel-div{
    margin:0;
    width: 80%;
    height: inherit;
    background-position: center;
    float: left;
    background-size: cover;
    background-repeat: no-repeat;
}

/* Ensures that Flickity waits until CSS has loaded to calculate the height of the cells */
.carousel:after {
  content: 'flickity';
  display: none; /* hide :after */
}



.feature-img{
    width: inherit;
    height: 300px;
    background-origin: border-box;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center
}

    </style>
@endpush
@extends('layouts.app')
@section('content')
<div class="container border-0">
    <h1 class="banner-header text-dark">Special offers</h1><br>

        @if(!$Featured->isEmpty())
       
        @if ($Featured->count() < 3)
        <div class="row">
            @foreach ($Featured as $feature)
            <div class="col-6">
                <div class="d-flex flex-column bd-highlight justify-content-center">
                    <div class="bd-highlight p-2">
                            <div class="feature-img" style="background-image:url({{$feature->findProduct($feature->product_id)->getImage('product_images')}})"></div>
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <p class="">{{$feature->findProduct($feature->product_id)->title}}</p>
                                    <a href="#">{{$feature->findProduct($feature->product_id)->store->name}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
            @endforeach
          </div>  
          @endif
       
    @if ($Featured->count() > 2)
        <div class="row">
            <div class="col-12">
            <div class="carousel js-flickity" data-flickity='{ "wrapAround": true, "autoPlay": true }'>
            @foreach ($Featured as $feature)
            <div class="carousel-cell">
                <div class="d-flex flex-column bd-highlight border justify-content-center">
                    <div class="bd-highlight p-2">
                        <div class="carousel-div">
                            <div class="feature-img" style="background-image:url({{$feature->findProduct($feature->product_id)->getImage('product_images')}})"></div>
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <p class="">{{$feature->findProduct($feature->product_id)->title}}</p>
                                    <a href="#">{{$feature->findProduct($feature->product_id)->store->name}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
             @endforeach   
            </div>
            </div>
            </div>
           
            @endif

            @else
            <h1 class="h5 text-center"> No offers available
                @endif
        </div>


<div class="row m-5">
    <div class="col-12">
        <nav class="nav justify-content-center navbar-dark">
            <a class="nav-link breadcrumb-item active" href="#">Cars</a>
            <a class="nav-link breadcrumb-item" href="">Farm</a>
            <a class="nav-link breadcrumb-item" href="">Fashion</a>
            <a class="nav-link breadcrumb-item active" href="#">Electronics</a>
         </nav>  
    </div>
</div>
</div>

<div class="container">
    @if ($products->count()>0)
        
    <div class="section1 row justify-content-center justify-content-lg-start">
        
              {{-- <span class="banner-text">Outdoors Unlimited specalizes in high quality outdoors supplies & equipment.</span> --}}
          
     

        @foreach ($products as $prod)
                @include('layouts.product',['item'=>$prod,'show'=>false])
        @endforeach
         </div>
        @else
        <h1 class="h5 text-center"> No products to display
        </h1>
        @endif
   
</div>





@endsection