@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-4">

                            {{-- <div class="login-header">
                                <a class="navbar-brand" href="/">
                                    <img src="{{asset('icons/bazzaarlogo.png')}}" style="max-width:50px;display:inline-block;padding:0;margin:0" class="" alt="">
                                    <span style="color:#000;font-weight:bold;letter-spacing:1px;font-size:20px;margin-left:-15px">Bazzaar</span>
                                </a>
            
                            </div> --}}
                        <h2 class="h2head">{{Auth::user()->stores->name}} Login</h2>
                            <h6 style="padding-left:10px">Contine to store</h6>
                            <div class="main-form">
                                <form method="POST" action="{{ route('store.login.dashboard') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" placeholder="Store email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" placeholder="Store password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                            
                            </div>
        
                        </form>
                        </div>



        </div>
    </div>
</div>
@endsection
