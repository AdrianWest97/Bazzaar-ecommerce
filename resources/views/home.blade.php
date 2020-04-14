@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom h1">My profile</div>

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
                        <div class="p-2 bd-highlight"><a href="javascript:;">Change password</a></div>
                      </div>
                    </div>

                    <div class="col-6 text-right">
                        <a href="javascript:;">Delete account</a>
                    </div>
                </div>
                      <hr>
                    @if ($stores)
                    <h1 class="h5 m-3">Your stores</h1>
                    @foreach ($stores as $store)
                
                            <div class="list-group">
                                <a href="{{route("store.show.admin",["store"=>$store])}}" class="nav-link">{{$store->name}}</a>
                            </div>
                        

                    @endforeach

                    @else
                    <div class="list-group">
                        <a href="{{route("store.create")}}" class="nav-link">Start a store for free!</a>
                    </div>
                    @endif
                    
                   
                </div>
                <div class="card-footer">
                    <a name="" id="" class="btn btn-primary baz-button" href="{{route("store.create")}}" role="button">Create store</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
