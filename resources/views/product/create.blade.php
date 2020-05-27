

@push("css")
<link rel="stylesheet" href="{{asset('css/product-create.css')}}">
<link rel="stylesheet" href="{{asset('css/tagsinput.css')}}">
@endpush
@push('scripts')
<script src="{{asset('js/tagsinput.js')}}" defer></script>
    <script>
      function getForm(){
        var form_type = $("#form_type").val();
        if(form_type!=""){
        window.location.replace(form_type);
        }

      }
      </script>
<script src="{{asset('js/product-create.js')}}"></script>
{{-- <script src="{{asset('js/image-change.js')}}"></script> --}}
@endpush


@extends('layouts.store')
@section('store_content')
<nav class="nav justify-content-start navbar-dark m-lg-3">
   <a class="nav-link breadcrumb-item {{Request::segment(4) == "empty" ? 'active': ''}}" href="{{route('product.create',['store'=>$store,'product_type'=>'empty'])}}">Add product</a>
   <a class="nav-link breadcrumb-item active" href="#">{{Request::segment(4) != "empty" ? Request::segment(4): ''}}</a>
</nav>
<div class="container">
<div class="row justify-content-center m-lg-5">
  <div class="col-12">
    @include('layouts.messages')
    {{-- @include('layouts.messages') --}}
      
     @if ($product_type == "" || $product_type == "empty")
    <div class="form-group row">
      <div class="col-12">
        <label for="form_type">What type of product would you like to create? </label> 
        <select id="form_type" class="custom-select">
          <option value="cars">Cars</option>
          <option value="electronic">Electronic</option>
          <option value="farm">Farm</option>
          <option value="fashion">Fashion</option>
        </select>
      </div>
  
    </div>
    <div class="form-group row justify-content-end">
    <div class="col-12">
      <a onclick="getForm()" class="btn btn-default theme-btn" href="javascript:;" role="button">Continue</a>
  </div>
    </div>
     @endif
      
            @switch($product_type)
                @case('farm')
                    @include('layouts.farm-product-create')
                    @break
                    @case('cars')
                    @include('layouts.vehicle-product-create')
                    @break
                    @case('fashion')
                    @include('layouts.fashion-product-create')
                    @break
                    @case('electronic')
                    @include('layouts.electronic-product-create')
                    @break;
                @default
            @endswitch
      
  </div>
</div>
</div>

@endsection