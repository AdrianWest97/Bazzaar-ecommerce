@extends('layouts.store')

@section('store_content')

<div class="row justify-content-center m-md-3">
<div class="col-12 col-lg-9">
<div class="card">
    <div class="card-header">
        Update store information
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('store.settings.update',['store'=>$store])}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Unique store name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" placeholder="Store name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $store->name}}"  autocomplete="name">
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
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="text" value="{{Auth::user()->email ?? old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="text" value="{{old('phone') ?? $store->phone }}" placeholder="eg. 1876000000" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="phone">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

                                    
            {{-- <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> --}}
            {{-- <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" placeholder="Confirm-password" type="password" class="form-control custom-input" name="password_confirmation" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> --}}



            <div class="form-group row">
                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                <div class="col-md-6">
                    <input id="country" type="text" placeholder="Country" value="{{old('sountry') ?? $store->address->country}}" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}"  autocomplete="country">
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
                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street line') }}</label>
                <div class="col-md-6">
                    <input id="street" type="text" placeholder="street" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') ?? $store->address->street}}"  autocomplete="street">
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('About store') }}</label>

                <div class="col-md-6">
                <textarea id="description" rows="3" cols="5" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description">{{$store->description ?? ''}}</textarea>
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
                        {{ __('Update store') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
</div>
</div>

@endsection