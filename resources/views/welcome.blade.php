
@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@15.2.0/dist/lazyload.min.js"></script> --}}
<script src="{{asset('js/jquery.jscroll.min.js')}}"></script>
<script type="text/javascript">

$(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true,
        variableWidth: true,
        adaptiveHeight: true,
        autoplay: true,
         autoplaySpeed: 2000,
        
      });

    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
loadingHtml: '<img src="{{asset("images/loading.gif")}}" alt="Loading" /> Loading...',


            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });

        
// //laxy load
// var myLazyLoad = new LazyLoad({
//   elements_selector: ".lazy",
//   load_delay: 300 //adjust according to use case
// });

    });

</script>

{{-- <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script> --}}
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('slick/slick-theme.css')}}">
<style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 100%;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }

    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }

    .image-bg{
        height: 300px;
        width: 100%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center
    }

    @media (max-width: 500px) {
        .image-bg{
        height: 200px;
        width: 100%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center
    }
    }
  </style>



@endpush
@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-12 m-lg-5">
        <div class="h2">Special offers</div>
    </div>
</div>
<div class="dropdown-divider"></div>

<section class="variable slider m-lg-5">
    @if(!$Featured->isEmpty())
    @foreach ($Featured as $feature)
    <div>
      <div class="row">
        <div class="col s12 m7">
          <div class="card border-0" style="width: 250px;">
            <div class="card-image p-2">
            <a href="{{route('product.view',['product'=>$feature->findProduct($feature->product_id)])}}">
            <div class="image-bg rounded" style="background-image: url({{$feature->findProduct($feature->product_id)->getImage('')}})">
            </div>
              <span class="card-title">{!! Str::limit($feature->findProduct($feature->product_id)->title),15,"..."!!}</span>
            </a>
                </div>

            <div class="card-content">
              
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
    @endforeach
    @endif
</section>
<div class="dropdown-divider"></div>

</div>




{{--    
   <!--slider--->
   <div class="container border-0">
    <div class="row">
        <div class="w-100">
        @if(!$Featured->isEmpty())
        <h1 class="banner-header text-dark p-5">Special offers</h1>

       
         @if ($Featured->count() < 3)
        <div class="row m-lg-0 p-2">
          @foreach ($Featured as $feature)
          <div class="col-12 col-md-6">
          <div class="card">
            <img class="card-img-top" style="height: 300px;" src="{{$feature->findProduct($feature->product_id)->getImage('')}}" alt="product image">
            <div class="card-body">
              <h5 class="card-title">{{$feature->findProduct($feature->product_id)->title}}</h5>
              <p class="card-text">@convert($feature->findProduct($feature->product_id)->price){{$feature->findProduct($feature->product_id)->currency}}</p>
              <a href="{{route('product.view',['product'=>$feature->findProduct($feature->product_id)])}}" class="btn btn-default theme-btn">View product</a>
            </div>
          </div>
          </div>
          @endforeach      
        </div>
        @endif 

            @if ($Featured->count() > 2)
            <div class="col-12">
            <div class="carousel js-flickity" data-flickity='{ "wrapAround": true, "autoPlay": true}'>
            @foreach ($Featured as $feature)
            <div class="carousel-cell mx-lg-auto p-lg-1">
                        <div class="carousel-div">
                            <a href="{{route('product.view',['product'=>$feature->findProduct($feature->product_id)])}}">
                            <div class="feature-img" style="background-image:url({{$feature->findProduct($feature->product_id)->getImage('')}})"></div>
                            <ul class="list-group">
                                <li class="list-group-item text-center border-0">
                                    <p class="">{{$feature->findProduct($feature->product_id)->title}}</p>
                                    <h1 class="h5 m-0 p-0">${{$feature->findProduct($feature->product_id)->price}}</h1>
                                   {{$feature->findProduct($feature->product_id)->store->name}}
                                </li>
                            </ul>
                            </a>
                     
        </div>
            </div>
             @endforeach   
            </div>
            </div>
            @endif

            @else

           @endif
        </div>
    </div>
</div>
--}}

 






<div class="container-fluid">
    @if ($products->count()>0)
    <div class="infinite-scroll">
    <div class="row m-lg-5">
        @foreach ($products as $prod)
         @include('layouts.product',['item'=>$prod])
        @endforeach
        {{$products->links()}}
    </div>
    </div>



        @else
        <div class="row justify-content-center">
            <div class="col-8 col-md-3">
             <img src="{{asset('icons/no-products.jpg')}}" class="img-fluid" alt="">
             <div class="h4">No products available
             </div>
                 </div>
             </div>
    @endif
</div>
@endsection
@section('footer')
@include('layouts.footer')
@endsection
