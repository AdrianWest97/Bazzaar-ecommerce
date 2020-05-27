@extends('layouts.app')

@section('content')

@push('scripts')
<script src='{{asset('js/edit-image.js')}}'></script>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom h1">
                    <div class="d-flex flex-row">

                    <div class="bd-highlight p-2">
                        {{-- {{asset('avatars/default-user.jpg')}} --}}
                        <div class="avatar-preview-smaller">
                            @if (Auth::user()->avatar != null && Auth::user()->avatar->image !=null)
                            <div id="avatar" style="background-image: url({{asset('avatars/'.Auth::user()->avatar->image)}});"></div>
                            @else
                            <div id="avatar" style="background-image: url({{asset('avatars/default-user.jpg')}});">
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="bd-highlight p-2">
                    {{Auth::user()->firstname}} {{Auth::user()->lastname}}
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="row justify-content-lg-around">
                    <div class="col-6">
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</div>
                        <div class="p-2 bd-highlight">{{Auth::user()->email}}</div>
                        <div class="p-2 bd-highlight"><a href="javascript:;" data-toggle="modal" data-target="#exampleModal">Edit profile</a></div>
                      </div>
                    </div>

                    <div class="col-6 text-right">
                        <a href="javascript:;"></a>
                    </div>
                </div>
                      <hr>
                    @if ($store)
                    <h1 class="h5 m-3">Your store</h1>
                            @if (Auth::guard('store')->check())
                            <div class="list-group">
                                <a href="{{route("store.admin-dashboard")}}" class="nav-link block">{{$store->name}}</a>
                            </div>
                            @else

                            @if(Auth::user()->stores->password == "")
                            <div class="list-group">
                                <a href="{{route("add.store.password")}}" class="nav-link block">{{$store->name}}</a>
                            </div>
                            @else
                            <div class="list-group">
                                <a href="{{route("store.login")}}" class="nav-link block">{{$store->name}}</a>
                            </div>
                            @endif
                            @endif
                          
                    @else
                    <div class="list-group">
                        <a href="{{route("store.create")}}" class="nav-link">Start your store for free</a>
                    </div>
                    @endif
                   
                </div>
            
            </div>
        </div>
    </div>
</div>


  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-lg-5">
            <div class="d-flex flex-row justify-content-center">
                    <div class="bd-highlight p-2">
                        <form id="imageUploadForm" action="{{route('update.profile.photo')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('POST')
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    @if (Auth::user()->avatar !=null && Auth::user()->avatar->image !=null)
                                    <div id="imagePreview" style="background-image: url({{asset('avatars/'.Auth::user()->avatar->image)}});"></div>
                                    @else
                                    <div id="imagePreview" style="background-image: url({{asset('avatars/default-user.jpg')}});">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
       

     <form action="{{route('update.profile')}}" enctype="multipart/form-data" method="post">
         @csrf
        @method('PATCH')    
        <div class="form-group row">
           <div class="col-12 col-lg-6">
          <label for="">First name</label>
          <input type="text" name="firstname" value="{{old('firstname') ?? Auth::user()->firstname}}" id="" class="form-control form-control-lg @error('firstname') is-invalid @enderror" placeholder="">
          @error('firstname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
           <div class="col-12 col-lg-6">
            <label for="">Last name</label>
            <input type="text" name="lastname" value="{{old('lastname') ?? Auth::user()->lastname}}" id="" class="form-control form-control-lg @error('lastname') is-invalid @enderror" placeholder="">
            @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror     
        </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
           <label for="">Phone</label>
           <input type="text" name="phone" value="{{old('phone') ?? Auth::user()->phone}}" id="" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="">
           @error('phone')
           <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
           </span>
       @enderror
        </div>
         </div>
        <h4>Address</h4>
        <div class="form-group row">
            <div class="col-12 col-lg-6">
           <label for="">Country</label>
           <input type="text" name="country" value="Jamaica" readonly id="" class="form-control form-control-lg @error('country') is-invalid @enderror" placeholder="">
            </div>
            <div class="col-12 col-lg-6">
             <label for="">Parish</label>
             <select class="form-control selectpicker custom-select-c custom-select-lg" name="parish" data-size="7" data-live-search="true" data-title="Parish" id="parish_list" data-width="100%">
                <option selected value="Kingston">Select Parish</option>
               <option value="Hanover">Hanover</option>
               <option value="Saint Elizabeth">Saint Elizabeth</option>
               <option value="Saint James">Saint James</option>
               <option value="Trelawny">Trelawny</option>
               <option value="Westmoreland">Westmoreland</option>
               <option value="Clarendon">Clarendon</option>
               <option value="Manchester">Manchester</option>
               <option value="Saint Ann">Saint Ann</option>
               <option value="Saint Catherine">Saint Catherine</option>
               <option value="Saint Mary">Saint Mary</option>
               <option value="Kingston">Kingston</option>
               <option value="Portland">Portland</option>
               <option value="Saint Andrew">Saint Andrew</option>
               <option value="Saint Thomas">Saint Thomas</option>
              </select>
              @error('parish')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
              </div>
         </div>

         <div class="form-group row">
            <div class="col-12">
           <label for="">Streetl line</label>
           <input type="text" name="street" value="{{old('street') ?? Auth::user()->address->street ?? ''}}" id="" class="form-control form-control-lg @error('street') is-invalid @enderror" placeholder="">
           @error('street')
           <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
           </span>
       @enderror
        </div>
         </div>
         <button type="submit" class="btn btn-default btn-lg theme-btn float-right">update profile</button>
     </form>
    </div>
      </div>
    </div>
  </div>
  
@endsection
