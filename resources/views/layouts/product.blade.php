
<div class="col-6 col-lg-3">
  <a class="text-dark text-decoration-none" href="{{route('product.view',['product'=>$item])}}">

 <div class="product">
<div class="wrapper" style="background-image:url({{$item->getImage('')}})">
  <div class="container">
    <div class="top"></div>
    <div class="bottom">
      <div class="left">
        <div class="details">
          <h1 class="h6">
           {!! Str::limit($item->title, 20, ' ...') !!}
          </h1>
     
          <p>@convert($item->price){{$item->currency}}</p>
          @featured($item)
          <span class="badge badge-success">Featured</span>
          @endfeatured
        </div>
        <div class="buy">
          <a onclick="addTocart('{{$item->id}}');" href="javascript:;" role="button"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mobile-text">
  <p>{!! Str::limit($item->title, 20, ' ...') !!}<p>
    <p>@convert($item->price){{$item->currency}}</p>
  </div>

</div>
</a>

</div>
