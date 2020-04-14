
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
  
        <div class="col-md-8 m-5">
            {{-- @include('layouts.messages') --}}
            <h2 class="text-center">Start you free store today!</h2>
 
            <div class="card border-0">
                
                <div class="card-header border-0 bg-transparent text-center">
                    
            
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Use a unique store name that speaks to products you will promote') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Store name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner" class="col-md-4 col-form-label text-md-right">{{ __('owner') }}</label>
                            <div class="col-md-6">
                                <input id="owner" type="text" value="{{Auth::user()->firstname}} {{Auth::user()->lastname}}" class="form-control @error('owner') is-invalid @enderror" name="owner" value="{{ old('owner') }}"  autocomplete="owner">
                                @error('owner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('How can we send you emails and notifications?') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" value="{{Auth::user()->email}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <input id="country" type="text" placeholder="Country" value="Jamaica" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}"  autocomplete="country">
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="parish" class="col-md-4 col-form-label text-md-right">{{ __('parish') }}</label>
                        <div class="col-md-6">
                            <select id="parish" name="parish" class="custom-select @error("parish") is-invalid @enderror" value="{{ old('parish') }}"  autocomplete="parish">
                                <option value="kingston">Kingston</option>
                                <option value="manchester">Manchester</option>
                                <option value="St. James">St. James</option>
                              </select>
                            @error('parish')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street line') }}</label>
                            <div class="col-md-6">
                                <input id="street" type="text" placeholder="street" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}"  autocomplete="street">
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('dexcription') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" rows="3" cols="5" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description"></textarea>
                                <span id="characterLeft" class="text-small"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="baz-button">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
