@extends('layouts.app')
@section('content')
    <div class="container">
      @include('layouts.messages')
      <div style="display:none" class="alert alert-success notify alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only"></span>
        </button>
        <strong>Success!</strong>Message sent successfully.
      </div>
      <div class="row justify-content-center m-2" >
          <div class="col-12 col-lg-6">
            <div class="d-flex flex-row bd-highlight mb-3 justify-content-center">
                <!--main image -->
                <div class="p-2 bd-highlight">
                    <img src={{$product->getImage("product_images")}} class="main-product-image" />
                </div>
              </div>
              <div class="d-flex flex-row bd-highlight mb-3 justify-content-start" style="">
                @foreach ($product->images as $img)
                <div class="p-2 bd-highlight">
                <img src={{$product->get_small_image($img->image,"thumbnail")}} class="img-fluid" />
                </div>
                @endforeach
            </div>
          </div>

          <div class="col-12 col-lg-5 m-2">
              <div class="product-summary">
                  <h1 class="h5 product-title">
                      {{$product->title}}
                  </h2>
                  <p class="product_price">${{$product->price}}</p>
                  <p>{{$product->description}}</p>
                  <p>Store: <a href="{{route('store.index',['store'=>$product->store])}}">{{$product->store->name}}</a></p>
                  <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$product->store->address->parish}},{{$product->store->address->country}}</p>
                  <div class="d-flex flex-column bd-highlight " style="">
                  @switch($product->type)
                   @case("car")
                   <div class="p-2 bd-highlight">Make: {{$product->make}}</div>
                   <div class="p-2 bd-highlight">Model: {{$product->model}}</div>
                   <div class="p-2 bd-highlight">Transsmision: {{$product->transmission}}</div>
                   <div class="p-2 bd-highlight">Year: {{$product->year}}</div>
                   @break
                   @case("farm")
                   <div class="p-2 bd-highlight">Weight: {{$product->weight}} {{$product->unit}}</div>
                   <div class="p-2 bd-highlight">Quantity: {{$product->uantity}}</div>
                   @break
                   
                   
                  @endswitch
        
              </div>
              
              <div class="d-flex flex-row bd-highlight " style="">
                <div class="p-2 bd-highlight">
                <a href="{{route('product.addToCart',['id'=>$product->id])}}" class="baz-button" onclick="" href="{{route('product.addToCart',['id'=>$product->id])}}">
                    <span class="fa fa-heart-o"></span>&nbsp; save product
                </a>
                </div>
              </div>
              <div class="d-flex flex-row bd-highlight " style="">
                <div class="p-2 bd-highlight"><a href="javascript:;" class="fa fa-envelope-open"   data-toggle="modal" data-target="#exampleModal" aria-hidden="true">&nbsp;Send message</a></div>
                <div class="p-2 bd-highlight"><a href="javascript:;" class="fa fa-share-alt" aria-hidden="true"></a>&nbsp;Share</div>

              </div>
          </div>
      </div>
    
    </div>


  @if($product->similar($product->type))
    <div class="container p-5">
      <h1 class="text-left">Similar products</h5>
      <hr/>
        <div class="row justify-content-center">
            <di class="col-12">
              <div class="row">
            @foreach ($product->similar($product->type) as $item)
            @if ($item->id !== $product->id)
            @include('layouts.product',['item'=>$item,'show'=>false])

            @endif
            @endforeach
              </div>
        </div>
    </div>
    @endif

    <div class="container p-5">
      <h1 class="text-left">Reviews</h1>

      @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
      <hr/>
      <div class="row justify-content-start">
        <div class="col m-3">
          @if(!$product->reviews->contains('email',session()->get('temp_user')))
          <p>Write product review</p>
          <form action="{{route('product.review',['id'=>$product->id])}}" method="POST">
            @csrf
          @guest
              <div class="form-group row">
                <div class="col">
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
                <div class="col">
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
              <button type="submit" class="btn baz-button">Submit</button>
          </form>
        @endif 
    </div>

  </div>
        <div class="row">
          <div class="col-12">
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
        </div>
    </div>

    </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message seller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @auth
      <form id="query-form" action="{{route('send.mail.query')}}" method="post">
        @csrf
        <input type="hidden" name="from" value="{{Auth::user()->email ??  Session::get('temp_user') ?? ''}}">
        <input type="hidden" name="to" value="{{$product->store->email ?? ''}}">
      <div class="modal-body">
      <div class="form-group">
        <label for="">Subject</label>
        <input type="text" name="subject" value="{{$product->title}}" id="subject" class="form-control" placeholder="" aria-describedby="helpId">
      </div>
      <div class="form-group">
        <label for="">Message</label>
        <textarea class="form-control custom-input" placeholder="Tyoe your message" name="message" id="message" rows="3"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="baz-button send">Send mail</button>&nbsp;
        <button type="reset" class="baz-button"  data-dismiss="modal">Cancel</button>
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
  
  
</div>

    
@endsection

@push('scripts')
    <script>
      $(function(){
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
                  $(".notify").show();
                  form.find(".send").replaceWith('<button type="submit" class="baz-button send">Send mail</button>');
                  form.find('input[type=reset]').click();
                  $("#exampleModal").modal('hide');
                  console.log(response);
                },
                error(err){
                  console.log(err);
                }
              });
      
      });
      });
      </script>
@endpush