@extends('layouts.app')

@push('css')
    <style>
        
       </style>
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

                            <h6 class="mt-3">Contine to your account</h6>
                            <div class="main-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" placeholder="Email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" placeholder="Password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="">
                                            <input type="submit" value="Sign in" class="btn btn-md btn-default theme-btn" />
                                        </div>
                                    </div>
                                
                                <p style="margin-top:10px">
                                    New to Bazzaar?
                                   <a href="{{route('register')}}">Register here</a>
            
                                </p>
                            </div>
        
                        </form>
                        </div>



        </div>
    </div>
</div>
@endsection
