@if (!is_null($item))
<div class="card border-0">
    <div class="card-body P-0">
<div class="d-flex flex-column bd-highlight mb-3 ">
    <div class="p-2 bd-highlight">
        <div class="similar-image-large" style="background-image:url({{$item->getImage('product_images')}})"></div>
    </div>
    <div class="p-2 bd-highlight" style="margin-top:-20px">
        <p class="card-title font-weight-lighter mb-2"><a href="{{route('product.view',['product'=>$item])}}">{{$item->title}}</a></p>
        <div class="d-flex flex-row bd-highlight mb-3 ">
            <div class="p-1 m-0 bd-highlight">
             $ {{$item->price}} 
            </div>
            <div class="p-1 bd-highlight">
                {{$item->location}}, JM
                
            </div>

        </div>

    </div>
  
  </div>
</div>
</div>

{{-- 
    <div class="card-body p-0 ">
        <div class="bg-primary">
       
        </div>
    </div>
</div> --}}





{{-- <div class="card border-0" style="margin-top:20px;border-radius:0!important;background-color:#ffffff">
    <div class="product-image">
            <img src={{$item->getImage("thumbnail")}} class="card-img-top" alt="photo" style="max-height:400px">
    </div>
    <!--Card content-->
    <div class="card-body">
        <!--Title-->
        


        <div class="text-right">
           
        </div>
    </div>
    
</div> --}}

@endif

