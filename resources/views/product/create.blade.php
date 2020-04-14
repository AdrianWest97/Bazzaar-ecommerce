

@push("css")
<link rel="stylesheet" href="{{asset('css/product-create.css')}}">
@endpush
@push('scripts')
    <script>
      function getForm(){
        var form_type = $("#form_type").val();
        if(form_type!=""){
        window.location.replace(form_type);
        }

      }
      </script>
<script src="{{asset('js/product-create.js')}}"></script>
<script src="{{asset('js/image-change.js')}}"></script>
@endpush
@if ($data != null)

@extends('layouts.store',['store'=>$data])
@section('store_content')
<nav class="nav justify-content-start navbar-dark m-3">
   <a class="nav-link breadcrumb-item {{Request::segment(4) == "empty" ? 'active': ''}}" href="{{route('product.create',['store'=>$data['store'],'product_type'=>'empty'])}}">Add product</a>
   <a class="nav-link breadcrumb-item active" href="#">{{Request::segment(4) != "empty" ? Request::segment(4): ''}}</a>
</nav>

<div class="row justify-content-center m-5">

  <div class="col-lg-7 col-12">
    @include('layouts.messages')
    {{-- @include('layouts.messages') --}}
      
     @if ($data['product_type'] == "" || $data['product_type'] == "empty")
    
    <div class="form-group row">
      <div class="col-lg-12 col-12">
        <label for="form_type" class="col-12">What type of product would you like to create? </label> 
        <select id="form_type" class="custom-select">
          <option value="cars">Cars</option>
          <option value="electroic">Electroic</option>
          <option value="farm">Farm</option>
          <option value="fashion">Fashion</option>
        </select>
      </div>
    </div>
    <div class="form-group row justify-content-end">
      <div class="col-md-4 offset-md-4">
          <a onclick="getForm()" class="baz-button" href="javascript:;" role="button">Continue</a>
      </div>
  </div>
     @endif
      


            @switch($data['product_type'])
                @case('farm')
                    @include('layouts.farm-product-create')
                    @break
                    @case('cars')
                    @include('layouts.vehicle-product-create')
                    @break
                    @case('fashion')
                    @include('layouts.fashion-product-create')

                @default
                    
            @endswitch

    

      
  </div>
</div>

@endif

@endsection