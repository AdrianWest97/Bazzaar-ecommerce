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
        <div class="list-group list-group-flush">
            <a href="" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
             {{-- <h3> {{$store->name}}</h3> --}}
            </a>
            <a href="{{route("store.admin-dashboard")}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="home"></i></span>

                Dashboard
            </a>

            <a href="{{route("store.inventory")}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="shopping-cart"></i></span>
                products
            </a>
 
            <a href="{{route('store.analytics',['period'=>28])}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="bar-chart-2"></i></span>                Analytics
            </a>

           
            <a href="{{route('store.notifications')}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="bell"></i></span>
                            Notifications <span class="badge badge-danger">{{Auth::user("store")->Notifications ? Auth::user("store")->Notifications->count() : ''}}</span>
            </a>

    
            <a href="{{route('store.settings')}}" class="list-group-item list-group-item-action border-0 font-weight-bold bg-transparent">
                <i class="feather-16 feather-inline" data-feather="settings"></i></span>
                                Settings
            </a> 
    </div>
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
          <div class="row">
            <div class="col-lg-12">

    @yield('store_content')
   
</div>
          </div>
        </div>
    </div>




@endsection