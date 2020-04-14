
@if (!is_null($item))
<div class="card p-0 rounded-0 m-3 product">
  @if($show)
  <div class="d-flex flex-row bd-highlight justify-content-end">
    <div class="bd-highlight p-0">
    <div class="popup-menu js-popup">
        <a href="javascript:;" class="popup-menu-toggle js-popup-open">
          <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </a>
        <div class="popup-menu-wrapper js-popup-menu">
          <div class="popup-menu-panel shadow rounded">
            <a href="javascript:;" class="popup-menu-toggle js-popup-close">
              <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <ul class="popup-menu-list">
              <li class="popup-menu-item">
                <a href="{{route('product.feature',['id'=>$item->id])}}"><i class="fa fa-magic" aria-hidden="true"></i> Feature</a>
              </li>
              <li class="popup-menu-item">
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
              </li>
              <li class="popup-menu-item">
                <a href="javascript:;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
  </div>
  </div>
  @endif
    <div class="card-body p-0">
<div class="d-flex flex-column bd-highlight justify-content-center">
    <div class="bd-highlight p-0">
        <div class="product-image" style="background-image:url({{$item->getImage('product_images')}})"></div>
    </div>
    <div class="bd-highlight p-3 title">
        <a href="{{route('product.view',['product'=>$item])}}">{!! Str::limit($item->title, 30, ' ...') !!}
        </a>

        <div class="d-flex flex-row bd-highlight justify-content-center">
            {{-- <div class="p-2 bd-highlight">
                {{$item->location}},JM
                
            </div> --}}
            <div class="p-2 bd-highlight">
                ${{$item->price}} 
            </div>
            <div class="p-2 bd-highlight">
                <div class="feature-info-icon shadow-sm">
                <i class="fa fa-heart-o font-weight-bold hover" aria-hidden="true"></i>
                </div>
            </div>
            <div class="p-2 bd-highlight">
                <div class="feature-info-icon shadow">
                <a href="{{route('product.addToCart',['id'=>$item->id])}}" class="fa fa-cart-plus hover" aria-hidden="true"></a>
                </div>
            </div>
            <div class="p-2 bd-highlight">
             
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

