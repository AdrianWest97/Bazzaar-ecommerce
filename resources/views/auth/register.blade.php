@extends('layouts.app')
@push('scripts')
<Script src="{{asset('js/jquery-input-mask-phone-number.js')}}"></script>
    <script>
          //format to phone number format
      $('#phone').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
      });
        </script>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row" style="display: flex; justify-content: center; align-items: center; height: 85vh">
        <div class="col-md-4">
            <div class="login-header">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('icons/bazzaarlogo.png')}}" style="max-width:50px;display:inline-block;padding:0;margin:0" class="" alt="">
                    <span style="color:#000;font-weight:bold;letter-spacing:1px;font-size:20px;margin-left:-15px">Bazzaar</span>
                </a>

            </div>
            <h6 class="mt-3">Create an account and find products you need!</h6>
            <div class="main-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="form-group row">
                            <div class="col">
                                <input id="firstname" placeholder="First name" type="text" class="form-control form-control-lg @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="lastname" placeholder="Last name" type="text" class="form-control form-control-lg @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
               
                        <div class="form-group row">
                            <div class="col">
                                <input id="email" type="email" placeholder="Email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <input id="phone" type="phone" placeholder="Phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <input id="password" placeholder="Password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="password-confirm" placeholder="Confirm-password" type="password" class="form-control form-control-lg " name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

         
                        
                        <div class="form-group row">
                            <div class="col-12">
                                By clicking register, you agree to bazzaar terms and conditons
                                <a href="javascript:;">See terms and conditions</a>
                                <button type="submit" class="w-100 btn btn-md btn-default theme-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p style="margin:10px">
                        Login if you already have an account
                       <a href="{{'login'}}">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
