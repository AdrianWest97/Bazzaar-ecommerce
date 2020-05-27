@push('css')

@endpush
@extends('layouts.app')
 @section('content')
 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active">
        <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
      </li>
    </ul>
  </div>


<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="list-group list-group-flush">
            <a href="" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
             <h3> {{$store->name}}</h3>
            </a>
            {{-- <li href="{{route("store.admin-dashboard",['store'=>$store])}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
              <a name="" id="" class="btn btn-default theme-btn" href="#" role="button">Subscribe  <i class="feather-16" data-feather="bell"></i></span></a>
            </li> --}}
            <li href="{{route("store.admin-dashboard",['store'=>$store])}}" class="list-group-item list-group-item-action border-0 font-weight-lighter bg-transparent">
              Contact:<br>
              <div class="d-flex flex-column">
                <div class="bd-hightlight p-2">
                  <i  class="feather-inline feather-16" data-feather="mail"></i></span>
                  {{$store->email}}
                </div>
                <div class="bd-hightlight p-2">
                  <i class="feather-inline feather-16" data-feather="phone"></i></span>
                  {{$store->phone}}
                </div>
              </div>
            </li>
            <li href="{{route("store.admin-dashboard",['store'=>$store])}}" class="list-group-item list-group-item-action border-0 font-weight-lighter bg-transparent">
              About:<br><bR>
              <p>{{$store->description}}</p>

            </li>

            {{-- <a href="{{route("store.inventory",['store'=>$store])}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="shopping-cart"></i></span>
                products
            </a>

            <a href="{{route('store.analytics',['store'=>$store,'period'=>28])}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="bar-chart-2"></i></span>                Analytics
            </a>

            <a href="{{route('store.notifications',['store'=>$store])}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="bell"></i></span>
                            Notifications <span class="badge badge-danger">{{$store->Notifications ? $store->Notifications->count() : ''}}</span>
            </a>

    


            <a href="{{route('store.settings',['store'=>$store])}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="settings"></i></span>
                                Settings
            </a> --}}
          </ul>
    </div>

    <div id="page-content-wrapper" class="bg-light">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active">
                <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2">button</button>
              </li>
            </ul>
          </div>

        <div class="container-fluid">
       

    @yield('store-content')
   
</div>
          </div>
        </div>
    




@endsection