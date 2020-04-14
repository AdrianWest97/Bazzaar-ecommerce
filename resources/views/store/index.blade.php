@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('css/store.css')}}"/>
@endpush
@section('content')

<header class="header-banner-top">
    <div class="banner bg-light">
      
      <div class="banner-image"></div>
      
      <div class="primary-wrapper">
        
        <h1 class="site-title text-dark"><a href="#">{{$store->name}}</a></h1>
        {{-- <div class="site-tagline">Tagline. Aenean lacinia bibendum nulla sed consectetur. Maecenas sed diam eget risus varius blandit sit amet non magna. Nulla vitae elit libero, a pharetra augue.</div> --}}
        <nav class="nav justify-content-center navbar-dark">
            <a class="nav-link breadcrumb-item" href="">Farm</a>
            <a class="nav-link breadcrumb-item active" href="#">Cars</a>
            <a class="nav-link breadcrumb-item active" href="#">Electronics</a>
         </nav>  
      </div>
      
    </div>
  </header>

  <div class="container">
      <div class="row justify-content-lg-between">
          @foreach ($store->products as $item)
              @include('layouts.product',['item'=>$item,'show'=>false])
          @endforeach
      </div>
  </div>
@endsection