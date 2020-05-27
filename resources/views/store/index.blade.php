
@extends('layouts.store-sidebar')
@section('store-content')
<header class="header-banner-top">
  <div class="banner bg-light">
    
    <div class="banner-image"></div>
    
    <div class="primary-wrapper">
      
      {{-- <h1 class="site-title text-dark"><a href="#">{{$store->name}}</a></h1> --}}
      {{-- <div class="site-tagline">Tagline. Aenean lacinia bibendum nulla sed consectetur. Maecenas sed diam eget risus varius blandit sit amet non magna. Nulla vitae elit libero, a pharetra augue.</div> --}}
      {{-- <nav class="nav justify-content-center navbar-dark">
          <a class="nav-link breadcrumb-item" href="">Farm</a>
          <a class="nav-link breadcrumb-item active" href="#">Cars</a>
          <a class="nav-link breadcrumb-item active" href="#">Electronics</a>
       </nav>   --}}
    </div>
    
  </div>
</header>

<div class="container-fluid">
  <div class="d-flex flex-row mb-3 p-5">
    <div class="h2">Products</div>
  </div>
    <div class="row mt-lg-5">
        @foreach ($store->products as $item)
            @include('layouts.product',['item'=>$item,'show'=>false])
        @endforeach
    </div>
</div>
@endsection



{{-- @section('footer')
@include('layouts.footer')
@endsection --}}
