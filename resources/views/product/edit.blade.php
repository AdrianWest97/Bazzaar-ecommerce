@extends('layouts.store')
@section('store_content')


@push("css")
<link rel="stylesheet" href="{{asset('css/tagsinput.css')}}">
@endpush
@push('scripts')
<script src="{{asset('js/tagsinput.js')}}" defer></script>
{{-- <script src="{{asset('js/image-change.js')}}"></script> --}}
@endpush
<div class="container">
    <form action="{{route('product.update',['product'=>$product])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="{{$product->type}}">
        <div class="card">
            <div class="card-header">
                <h1 class="h4">Edit product</h1>
            </div>
    <div class="card-body justify-content-center">
        @include('layouts.messages')
        <div class="row">
  
            @switch($product->type)
                @case('farm')
                    @include('layouts.edit-farm')
                    @break
                @case('car')
                @include('layouts.edit-car')
                    @break
                @case('fashion')
                @case('electronic')
                    @include('layouts.edit-fashion')
                    @break
                @case('electronic')
                    @include('layouts.edit-electronic')
                    @break
                @default
                    
            @endswitch

        </div>
        {{-- <div class="dropdown-divider"></div> --}}
        {{-- <div class="h5">Product images</div> --}}
        {{-- <div class="row">
          
            @for ($i = 0; $i < $product->images->count(); $i++)
            <div class="col-lg-4 col-12">
                <label for="image{{$i}}">
                    <input type="file" name="image{{$i}}" accept="image/*" id="image{{$i}}" class="form-control" style="display:none" />
                    <img  src={{isset($product->images[$i]) ? $product->get_small_image($product->images[$i]->image,"") : asset('images/preview.png') }} 
                class="img-fluid rounded"
                 id="imagePreview{{$i}}"/>   

                <img src="{{asset('images/preview.png')}}" class="img-fluid " id="image_preview_{{$i}}" /> 
                  </label>
            </div>
            @endfor
        </div>
        --}}
   
        </div>

        <div class="card-footer">
            <button type="submit" class="baz-button float-right">Update info</button>
        </div>
    </form>
</div>

@endsection