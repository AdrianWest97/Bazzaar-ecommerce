@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('css/lightslider.css')}}">
@endpush

@push('scripts')
<script src="{{asset('js/lightslider.js')}}"></script> 

    <script>
      $(document).ready(function(){
        $("#query-form").on("submit",function(e){
        e.preventDefault();
          var form = $(this);
          form.find(".send").replaceWith('<button type="submit" disabled class="baz-button send">Sending  <i class="fa fa-spinner fa-spin"></i></button>');
        //ajax
        $.ajax({
                url:  $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                  form.find(".send").replaceWith('<button type="submit" class="baz-button send">Send mail</button>');
                  $("#query-form").trigger("reset");
                  $("#exampleModal").modal('hide');
                  //show toast notification
                  Toastify({
                        text: "Message sent successfully",
                        duration: 3000, 
                        // destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: 'left', // `left`, `center` or `right`
                        backgroundColor: "rgb(142,199,61)",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function(){} // Callback after click
                      }).showToast();

                },
                error(err){
                  $("#query-form").trigger("reset");
                  $("#exampleModal").modal('hide');
                  Toastify({
                        text: "Could not send message",
                        duration: 6000, 
                        // destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: 'left', // `left`, `center` or `right`
                        backgroundColor: "red",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function(){} // Callback after click
                      }).showToast();
                  console.log(err);
                }
              });
      });

      $("#content-slider").lightSlider({
           loop:true,
           keyPress:true
       });
       $('#image-gallery').lightSlider({
           gallery:true,
           item:1,
           thumbItem:9,
           slideMargin: 0,
           speed:500,
           auto:true,
           loop:true,
           controls:false,
           enableTouch:true,
           onSliderLoad: function() {
               $('#image-gallery').removeClass('cS-hidden');
           }  
       });
  });
    </script>
@endpush


@section('content')
<div class="container">
      @include('layouts.messages')
     <div class="row p-lg-5 mx-lg-auto justify-content-center bg-light">
          <div class="col-12 col-lg-6">
            <div class="demo">
              <div class="item">            
                  <div class="clearfix" style="max-width:474px;">
                      <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                        @foreach ($product->images as $img)
                        <li data-thumb={{$product->get_small_image($img->image,"medium")}}> 
                          <img src={{$product->get_small_image($img->image,"")}} class="img-fluid rounded" />
                        </li>
                        @endforeach
                      </ul>
                  </div>
              </div>
      
          </div>

          </div>

          <div class="col-12 col-lg-6">
              <div class="product-summary">
                  <h1 class="h5 product-title">
                      {{$product->title}}
                  </h2>
                  <p class="product_price">@convert($product->price){{$product->currency}}</p>
                  <p>{{$product->description}}</p>
                  <div class="d-flex bd-highlight" style="">

                    @customer($product->store->supplier)
                    <div class="p-2 flex-fill bd-highlight">
                    <a class="btn btn-default theme-btn w-100"  onclick="addTocart('{{$product->id}}');" href="javascript:;" >
                      <i data-feather="shopping-cart"></i>&nbsp; Add to cart
                    </a>
                    </div>
                    
                    <div class="p-2 flex-fill bd-highlight"><a href="javascript:;" class="btn btn-default theme-btn w-100"  data-toggle="modal" data-target="#exampleModal" aria-hidden="true"><i  data-feather="mail" class="feather-inline feather-24"></i> Send message</a></div>
                  </div>
                  <div class="p-2 flex-sm-fill bd-highlight"><a href="{{route('store.index',['store'=>$product->store])}}" class="btn btn-default theme-btn w-100"><i  data-feather="shopping-bag" class="feather-inline feather-24"></i> Go to store</a></div>

                  
                 @endcustomer
                  @auth
                  <div class="d-flex flex-column" style="">
                    <div class="p-2 bd-highlight"><i data-feather="map-pin" class="feather-inline feather-24"></i> {{$product->store->address->parish ?? ''}},{{$product->store->address->country ?? ''}}</div>
                      <div class="p-2 bd-highlight"><a href="tel:+{{$product->store->phone}}" class="text-dark text-decoration-none"><i  data-feather="phone" class="feather-inline feather-24"></i> {{$product->store->phone}}</a></div>
                  </div>
                  @endauth
                  @guest
                  <a href="{{route('register')}}">Create an account to see store information</a>
                  @endguest
                  <div class="d-flex flex-column bd-highlight " style="">
                  @switch($product->type)
                   @case("car")
                   <div class="p-2 bd-highlight">Make: {{$product->make}}</div>
                   <div class="p-2 bd-highlight">Model: {{$product->model}}</div>
                   <div class="p-2 bd-highlight">Transsmision: {{$product->transmission}}</div>
                   <div class="p-2 bd-highlight">Year: {{$product->year}}</div>
                   @if ($product->features)
                   <h3>Additional features</h3>
                   <div class="panel" style="list-style: none">
                    <div class="panel-content">

                 
                       @foreach (explode(',',$product->features) as $feature)
                      <button class="bootstrap-tagsinput badge p-1">
                        {{$feature}}
                      </button>
                       @endforeach
                    </div>
                   </div>
                   @endif
                   @break
                   @case("farm")
                   <div class="p-2 bd-highlight">Weight: {{$product->weight}} {{$product->unit}}</div>
                   <div class="p-2 bd-highlight">Quantity: {{$product->quantity}}</div>
                   @break
      
                  @endswitch
  
              </div>
              
    

          </div>
      </div>
    </div> 
</div>

<div class="container-fluid mt-5">
      @if($product->similar($product->type)->count() > 0)
      <div class="dropdown-divider"></div>
      <h1 class="text-center">Similar products</h1>

            <div class="row justify-content-start">
            @foreach ($product->similar($product->type) as $item)
            @include('layouts.product',['item'=>$item])
            @endforeach
            </div>
            @endif 
</div>

  <div class="container mx-auto mt-5">
    <h1 class="text-left">Reviews</h1>

      @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
      @endif

      <hr/>
      <div class="row justify-content-start">
        <div class="col-12 col-lg-6">
          @foreach ($product->reviews as $rev)
                <div class="shadow-sm p-2">
                <div class="d-flex flex-row bd-highlight " style="">
                  <div class="p-2 bd-highlight font-weight-bold">{{$rev->username}}</div>
                  <div class="p-2 bd-highlight">{{date('M d, Y', strtotime($rev->created_at))}}</div>
                </div>
                <div class="d-flex flex-column bd-highlight" style="">
                  
    
                  <div class="p-2 bd-highlight">
                        <fieldset class="rating">
                  @for ($i = 0; $i < $rev->rating; $i++)
                    <input type="radio" id="star{{$i}}" value="{{$i}}" disabled  checked>
                    <label class="full"
                    for="star{{$i}}"></label>
                        @endfor
                      </fieldset>
                  </div>
                      <div class="p-2 bd-highlight">
                    {{$rev->review}}</div>
                </div>
                </div>
                @endforeach
        </div>

        <div class="col-12 col-lg-6">
          @if(!$product->reviews->contains('email',session()->get('temp_user')))
          <p>Write product review</p>
          <form action="{{route('product.review',['id'=>$product->id])}}" method="POST">
            @csrf
          @guest
              <div class="form-group row">
                <div class="col-12 col-lg-6">
                <label for="">Name:</label>
                <input type="text"
                  class="form-control custom-input @error('username') is-invalid @enderror"
                   name="username" value="{{Auth::user()->firstname ?? old('usernname') }}" 
                   id="" autocomplete="username">
                  @error('username')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
                <div class="col-12 col-lg-6">
                  <label for="">Email:</label>
                  <input type="text"
                    class="form-control custom-input @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>
                </div>
                @endguest

                @auth
              <input type="hidden" name="username" value="{{Auth::user()->firstname ?? old('username')}}">
              <input type="hidden" name="email" value="{{Auth::user()->email ?? old('email')}}">
                @endauth

                <div class="form-group row">
                  <div class="col-sm-6 col-12">
                      <fieldset class="rating">
                          <input type="radio" id="star5" name="rating" value="5" /><label class="full"
                              for="star5" title="Awesome - 5 stars"></label>
                          
                          <input type="radio" id="star4" name="rating" value="4" /><label class="full"
                              for="star4" title="Pretty good - 4 stars"></label>
                            
                          <input type="radio" id="star3" name="rating" value="3" /><label class="full"
                              for="star3" title="Meh - 3 stars"></label>
                              
                          <input type="radio" id="star2" name="rating" value="2" /><label class="full"
                              for="star2" title="Kinda bad - 2 stars"></label>
                       
                          <input type="radio" id="star1" name="rating" value="1" /><label class="full"
                              for="star1" title="Sucks big time - 1 star"></label>

                      
                      </fieldset>
                      @error('rating')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>
              </div>

              <div class="form-group row">
                <div class="col">
                <label for="">Review:</label>
                <textarea class="form-control custom-textarea @error('review') is-invalid @enderror"  value="{{Auth::user()->review ?? old('review')}}" placeholder="Write review" name="review" id="" rows="3" autocomplete="review"></textarea>
                @error('review')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
              </div>
              <button type="submit" class="btn theme-btn">Submit</button>
          </form>
        @endif 
    </div> 

      </div> 
  
    
            
  </div>



          
        

     




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message seller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @auth
    <form id="query-form" action="{{route('message.user')}}" method="post">
        @csrf
        <input type="hidden" name="email" value="{{$product->store->email ?? ''}}">
      <div class="modal-body">
      <div class="form-group">
        <label for="">Subject</label>
        <input type="text" name="subject" value="{{$product->title}}" id="subject" class="form-control" placeholder="" aria-describedby="helpId">
      </div>
      <div class="form-group">
        <label for="">Message</label>
        <textarea class="form-control custom-input" name="message" id="message" rows="3"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default theme-btn send">Send message</button>&nbsp;
        <button type="reset" class="btn btn-default theme-btn"  data-dismiss="modal">Cancel</button>
      </div>
    </form>
    @endauth
    @guest
    <div class="modal-body">
    <a href="{{route('login')}}">Please login to send message</a>
    </div>
    @endguest
   
    </div>
  </div>
</div>

   
     
@endsection

@section('footer')
@include('layouts.footer')
@endsection
