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
                            <h2 class="h2head">Configure store password</h2>
                            <h6 style="padding-left:10px">For better security, we recommend you add a password for <b>{{Auth::user()->stores->name}}</b></h6>
                            <div class="main-form">
                                <form method="POST" action="{{route('update.store.password') }}">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <input id="email" type="password" placeholder="Password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="email" autofocus>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input id="password-confirm" placeholder="Confirm-password" type="password" class="form-control form-control-sm " name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>
                         
                                    </div>

                                    <div class="form-group">
                                        <div class="">
                                            <input type="submit" value="Update store" class="btn btn-md btn-default theme-btn" />
                                        </div>
                                    </div>
                                
                              
                            </div>
        
                        </form>
                        </div>



        </div>
    </div>
</div>
@endsection
