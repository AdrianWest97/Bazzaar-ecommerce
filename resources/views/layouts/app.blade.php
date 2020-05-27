<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
 

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!--font awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->


    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/site.css') }}" rel="stylesheet">

    <link href="{{ asset('css/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @stack("css")

</head>
<body style="display: none">
    <div id="app">
       
        <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top shadow-sm">
          <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('icons/bazzaarlogo.png')}}" class="img-fluid logo-nav d-inline-block align-content" alt="" srcset="">
                    {{ config('app.name', 'Bazzaar') }}<small class="font-weight-light"> v1.0</small>
                </a>
                <div class="mr-auto">
                  <a href="{{url('/')}}" class="ml-2 nav-item text-dark"><i data-feather="home"></i></a>

                  <a href="{{route('cart.items')}}" class="ml-2 nav-item text-dark" id="cart"><i data-feather="shopping-cart"></i><span id="cartcount" class="badge badge-success">{{Session::has('cart') ? Session::get('cart')->totalQty:''}}</span></a>
             </div>
                   <!-- Left Side Of Navbar -->

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"" aria-controls="navbarSupportedContent"" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">


              
        <div class="flex-grow-1 d-flex">
           <form class="form-inline flex-nowrap bg-light mx-0 mx-lg-auto ">
              <div class="ui fluid search w-100">
                <div class="ui icon input  w-100">
              <input type="search" class="prompt w-100 p-3"   placeholder="Search products" aria-label="search" aria-describedby="basic-addon1">
              <i class="search icon"></i>
            </div>
              <div class="results w-100"></div>
              </div>
          </form> 
        </div>

          
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}
                                 
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        {{-- <li class="nav-item d-flex align-items-center ml-lg-3 dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img alt="Image" src="https://demo.bootstrapious.com/directory/1-0/img/avatar/avatar-5.jpg" class="avatar avatar-sm"><span class="caret"></span>
                          </a>
                        </li> --}}

                            <li class="nav-item dropdown d-flex align-items-center ml-lg-3" style="margin-top:-4px ">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  @if (Auth::user()->avatar !=null && Auth::user()->avatar->image !=null)
                                  <img alt="Image" src="{{asset('avatars/'.Auth::user()->avatar->image)}}" class="avatar avatar-sm">
                                  @else
                                  <img alt="Image" src="{{asset('avatars/default-user.jpg')}}" class="avatar avatar-sm">
                                  @endif
                                  <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">My Account</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
            
                          
                            
                            <li class="nav-item">
                                <!--span class="notification-label"></span-->
                                <div class="dropdown-container">
                                  <a href="#" data-dropdown="notificationMenu" class="menu-link has-notifications circle nav-link">
                                    <i data-feather="inbox"></i>
                                        <span class="badge badge-success">{{Auth::user()->countNotifications() > 0 ? Auth::user()->countNotifications() : ''}}</span>
                                </a>
                                  <ul class="dropdown" name="notificationMenu">
                                    @store(Auth::user())
                                     <li class="notification-group">
                                      <div class="notification-tab">
                                        <i class="fa fa-shopping-cart"></i>
                                        <h4>Request</h4>
                                        <span class="label">{{Auth::user()->user_store_notifications > 0 ? Auth::user()->user_store_notifications :'0'}}
                                    </span>
                                      </div>
                                      <!-- tab -->
                                      <ul class="notification-list">
                                        @foreach (json_decode(Auth::user()->stores->notifications->where('type','App\Notifications\productRequest')) as $request)
                                        <li class="notification-list-item" onclick="showProdReqNoti('{{$request->id}}','{{Auth::user()->stores->id}}')">
                                        <p class="message">
                                        <div class="d-flex flex-row m-0 p-0">
                                          <div class="highlight p-0"><img class="img-fluid" src='{{App\Product::find($request->data->product)->getimage("thumbnail")}}'/></div>
                                          <div class="highlight p-1"><span class="{{is_null($request->read_at) ? 'font-weight-bold': ''}}">{!! Str::limit(App\Product::find($request->data->product)->title,50,'...')!!}</span></div>
                                        </div>
                                        </p>
                                           <div class="item-footer">
                                          <span class="from"><a href="#">{{$request->data->from->name}}</a></span>
                                            <span class="date">{{Carbon\Carbon::parse($request->created_at)->format("M d")}}</span>
                                          </div>
                                        </li>
                     
                                        @endforeach
                                      </ul>
                                    </li> 
                                    @endstore
                                    {{-- <li class="notification-group">
                                      <div class="notification-tab">
                                        <i class="fa fa-bug"></i>
                                          <h4>Bugs</h4>
                                          <span class="label">2/8</span>
                                      </div> <!-- tab -->
                                      <ul class="notification-list">
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project1</a></span>
                                            <span class="date">2 minutes ago</span>
                                          </div>
                                        </li>
                                       <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project2</a></span>
                                            <span class="date">12 hours ago</span>
                                          </div>
                                        </li>
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project3</a></span>
                                            <span class="date">2 days ago</span>
                                          </div>
                                        </li>
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project4</a></span>
                                            <span class="date">2 days ago</span>
                                          </div>
                                        </li>
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project5</a></span>
                                            <span class="date">2 days ago</span>
                                          </div>
                                        </li>
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project6</a></span>
                                            <span class="date">2 days ago</span>
                                          </div>
                                        </li>
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project7</a></span>
                                            <span class="date">2 days ago</span>
                                          </div>
                                        </li>
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@project8</a></span>
                                            <span class="date">2 days ago</span>
                                          </div>
                                        </li>
                                        
                                      </ul>
                                      <!-- list -->
                                    </li> --}}
                                    <li class="notification-group">
                                      <div class="notification-tab">
                                        <i class="fa fa-envelope"></i>
                                        <h4>Messages</h4>
                                        <span class="label">{{Auth::user()->notifications->where('type','App\Notifications\sendMessage')->count() > 0 ? Auth::user()->unreadNotifications->where('type','App\Notifications\sendMessage')->count():'0'}}</span>
                                      </div>
                                      <ul class="notification-list">
                                          @foreach (json_decode(Auth::user()->notifications->where('type','App\Notifications\sendMessage')) as $message)
                                          <li class="notification-list-item" onclick="showNotification('{{$message->id}}')">
                                          <p class="message"><span class="{{is_null($message->read_at) ? 'font-weight-bold': ''}}">{!! Str::limit($message->data->message,50,'...')!!}</span></p>
                                            <div class="item-footer">
                                            <span class="from"><a href="#">{{$message->data->from->firstname}} {{$message->data->from->lastname}}</a></span>
                                              <span class="date">{{Carbon\Carbon::parse($message->created_at)->format("M d")}}</span>
                                            </div>
                                          </li>
                       
                                          @endforeach
                                       
                                      </ul>
                                    </li>
                                    {{-- <li class="notification-group">
                                      <div class="notification-tab">
                                        <i class="fa fa-calendar"></i>
                                        <h4>Calendar</h4>
                                        <span class="label">2</span>
                                      </div>
                                      <ul class="notification-list">
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@mstrlaw</a></span>
                                            <span class="date">tomorrow</span>
                                          </div>
                                        </li>
                                       <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">@mstrlaw</a></span>
                                            <span class="date">in 2 days</span>
                                          </div>
                                        </li>
                                      </ul>
                                    </li> --}}
                                    {{-- <li class="notification-group">
                                      <div class="notification-tab">
                                        <i class="fa fa-trophy"></i>
                                        <h4>Badges</h4>
                                        <span class="label">2</span>
                                      </div>
                                      <ul class="notification-list">
                                        <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">technical</a></span>
                                            <span class="date">2 weeks ago</span>
                                          </div>
                                        </li>
                                       <li class="notification-list-item">
                                          <p class="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                          <div class="item-footer">
                                            <span class="from"><a href="#">personal</a></span>
                                            <span class="date">3 weeks ago</span>
                                          </div>
                                        </li>
                                      </ul>
                                    </li> --}}
                                  </ul>
                                </div>
                              </li>

                              {{-- <li class="nav-item">
                              <a href="{{route('cart.items')}}" class="text-dark nav-link" id="cart"><i data-feather="shopping-cart"></i><span class="badge badge-success" id="cartcount">{{Session::has('cart') && sizeof(Session::get('cart')->items) >0 ? Session::get('cart')->totalQty:''}}</span>
                              </a> --}}
                              </li>
                              <li class="nav-item">
                              <a href="{{route('about')}}" class="text-dark nav-link"><i data-feather="help-circle"></i></a>
                              </li>
                      
                        @endguest
                    </ul>
                    
                </div>
                          
                
          
              </div>
              
        </nav>
        
       
    
       

       
          <main class="py-4 mt-5">
            @yield('content')
        
        </main>
    </div>

 

                           @yield('footer')

                       <!-- Modal -->
                                        <div class="modal fade" id="expandMessageModal" tabindex="-1" role="dialog" aria-labelledby="expandMessageModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('message.user')}}" id="message-form" method="post">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-content rounded-0">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="expandMessageModalLabel"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                </div>
                                                <div class="modal-footer bg-light">
                                                <div class="d-flex flex-row flex-fill">
                                                     <input type="text"  class="form-control-lg border-0 rounded-0 w-100" placeholder="send message" name="message" id="message" placeholder="">
                                                </div>
                                                <button type="submit" class="btn btn-default theme-btn send"><i data-feather="send"></i></button>
                                                <input type="hidden" id="email" name="email"/>
                                                <input type="hidden" id="subject" name="subject" value="Query"/>
                                                </div>
                                            </div>
                                                </form>
                                            </div>
                                        </div>


                                        
<!-- Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form action="{{route('message.user')}}" id="message-form2" method="post">

      @csrf
      @method('POST')
     <div class="modal-content rounded-0">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="product_details">
    
      </div>
      <div class="modal-footer bg-light">
        <div class="d-flex flex-row flex-fill">
             <input type="text"  class="form-control-lg border-0 rounded-0 w-100" placeholder="send message" name="message" id="message" placeholder="">
        </div>
        <button type="submit" class="btn btn-default theme-btn send"><i data-feather="send"></i></button>
        <input type="hidden" id="email" name="email"/>
        <input type="hidden" id="subject" name="subject" value="Query"/>
        </div>
      </form>
  </div>
</div> 

</body>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('js/nprogress.js')}}" defer></script>
<script src="{{ asset('js/loader.js')}}" defer></script>
   <script src="{{asset('js/main.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> 
<script src="{{asset('semantic/semantic.min.js')}}"></script>
<script src="{{asset('slick/slick.min.js')}}" type="text/javascript" charset="utf-8"></script>





   <script>

      $.fn.modal = $.fn.modal.noConflict();

    feather.replace();
    $('.ui.search').search({
        apiSettings: {
            url: '/api/product/{query}',
            minCharacters : 3,
            onResponse: function(results) {    
                var response = {
                    results : []
                };    
                $.each(results, function(index, item) {              
                    response.results.push({
                        title       : item.title,
                        image       : item.image,
                        url       : item.url
                    });
                });    
                return response;
            },
        },
    });


      function showNotification(id){
         $.get("/get-message/"+id,function(data){
             body = "<div class='overflow-auto'>"+
                "<ul style='list-style-type:none'>"+
                    "<li class='p-2'>RE: "+data['subject']+"</li>"+
                    "<li class='p-2'><a href='javascript:;' class='font-weight-bold'>"+
                        data['from']['firstname']+" "+data['from']['lastname']+
                        "</a> <small>"+data['created_at']+"</small></li>"+
                            "</ul><div class='p-2'>"
                                +data['message']+
                                "</div></div>";

                $("#expandMessageModal").modal("show");
                $("#expandMessageModal").on("shown.bs.modal",function(){
                    $(this).find(".modal-body").html(body);
                    $(this).find("#email").val(data['from']['email']);
                    });

         });
        }


  function showProdReqNoti(id,store){
    $('#notificationModal').find('.modal-body').html("");

    $.get('/getProductRequestNotification/'+id+'/'+store,function(data){
        var body = "<p><div class='d-flex'>"+
        "<div class='bd-highlight p-2'>"+
        "<img class='img-fluid ' src='" +data['image']+"'/></div><div class='bd-highlight p-2'>"+
        "<ul class='modal-list'>"+
        "<li>Request by: "+data['from']['name']+"</li>"+
        "<li>Email: "+data['from']['email']+"</li>"+
        "<li>Phone: <a href='tel:"+data['from']['phone']+"'>"+data['from']['phone']+"</a></li>"+
        "</ul>"+
        "</div></div></p>";

    
        $('#notificationModal').modal('show');
        $('#notificationModal').on('shown.bs.modal', function() {
            $(this).find('.modal-title').text(data['title']);
             $(this).find('.modal-body').html(body).hide().fadeIn(500);
            //  $(this).find("#subject").val(data['title']);
             $(this).find("#email").val(data['from']['email']);
             });
        });
}


    $(function(){
        $("#message-form").on("submit",function(e){
                e.preventDefault();
                $(this).find(".send").replaceWith('<button type="submit" disabled class="btn btn-default theme-btn send"><i class="fa fa-spinner fa-spin"></i></button>');
                $.ajax({
                url:  $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $("#expandMessageModal").modal("hide");
                    $("#expandMessageModal").on("hidden.bs.modal", function(){
                        $(this).find(".modal-body").html("");
                        $("#message-form").trigger("reset");
                        $(this).find(".send").replaceWith('<button type="submit" class="btn btn-default theme-btn send"><i data-feather="send"></i></button>');
                        
                        //show toast notification
                        Toastify({
                        text: "Message sent successfully",
                        duration: 3000, 
                        // destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "rgb(142,199,61)",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function(){} // Callback after click
                      }).showToast();
                    });
                },
                error(err){
                  console.log(err);
                }
              });
      });

           $("#message-form2").on("submit",function(e){
                e.preventDefault();
                $(this).find(".send").replaceWith('<button type="submit" disabled class="btn btn-default theme-btn send"><i class="fa fa-spinner fa-spin"></i></button>');
                $.ajax({
                url:  $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $("#notificationModal").modal("hide");
                    $("#notificationModal").on("hidden.bs.modal", function(){
                        $(this).find(".modal-body").html("");
                        $("#message-form2").trigger("reset");
                        $(this).find(".send").replaceWith('<button type="submit" class="btn btn-default theme-btn send"><i data-feather="send"></i></button>');
                      
                        //show toast notification
                        Toastify({
                        text: "Message sent successfully",
                        duration: 6000, 
                        // destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: 'left', // `left`, `center` or `right`
                        backgroundColor: "rgb(142,199,61)",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function(){} // Callback after click
                      }).showToast();

                    });
                },
                error(err){
                  Toastify({
                        text: "Message sent successfully",
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
    });
</script>

@stack("scripts")

</html>
