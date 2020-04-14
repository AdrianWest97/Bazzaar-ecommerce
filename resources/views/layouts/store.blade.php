@extends('layouts.app')
 @section('content')
 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active">
        <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
      </li>
    </ul>
  </div>
 {{--
<div class="d-flex" id="wrapper" style="margin-top:-20px">
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <a href="" class="list-group-item list-group-item-action bg-light border-0 font-weight-bold">
             <h3> {{$data['store']->name}}</h3>
            </a>
            <a href="{{route("store.show.admin",["store"=>$data['store']])}}" class="list-group-item list-group-item-action bg-light border-0 font-weight-bold">
                <span class="fa fa-th-large fa-lg" aria-hidden="true"></span>

                Dashboard
            </a>

            <a href="{{route('store.inventory',['store'=>$data['store']])}}" class="list-group-item list-group-item-action bg-light border-0 font-weight-bold">
                <span class="fa fa-shopping-bag fa-lg" aria-hidden="true"></span>
                products
            </a>

            <a href="" class="list-group-item list-group-item-action bg-light border-0 font-weight-bold">
                <span class="fa fa-users fa-lg" aria-hidden="true"></span>
                Subscribers
            </a>

            <a href="" class="list-group-item list-group-item-action bg-light border-0 font-weight-bold">
                <span class="fa fa-bar-chart fa-lg" aria-hidden="true"></span>
                Analytics
            </a>

            <a href="" class="list-group-item list-group-item-action bg-light border-0 font-weight-bold">
                <span class="fa fa-gear fa-lg" aria-hidden="true"></span>
                Settings
            </a>
</div>
</div>
</div> --}}

<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <a href="" class="list-group-item list-group-item-action border-0 font-weight-bold">
             <h3> {{$data['store']->name}}</h3>
            </a>
            <a href="{{route("store.show.admin",["store"=>$data['store']])}}" class="list-group-item list-group-item-action border-0 font-weight-bold">
                <span class="fa fa-th-large fa-lg" aria-hidden="true"></span>

                Dashboard
            </a>

            <a href="{{route('store.inventory',['store'=>$data['store']])}}" class="list-group-item list-group-item-action border-0 font-weight-bold">
                <span class="fa fa-shopping-bag fa-lg" aria-hidden="true"></span>
                products
            </a>

            <a href="" class="list-group-item list-group-item-action  border-0 font-weight-bold">
                <span class="fa fa-users fa-lg" aria-hidden="true"></span>
                Subscribers
            </a>

            <a href="" class="list-group-item list-group-item-action border-0 font-weight-bold">
                <span class="fa fa-bar-chart fa-lg" aria-hidden="true"></span>
                Analytics
            </a>

            <a href="" class="list-group-item list-group-item-action border-0 font-weight-bold">
                <span class="fa fa-gear fa-lg" aria-hidden="true"></span>
                Settings
            </a>
    </div>
    </div>

    <div id="page-content-wrapper">
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active">
                <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2">eee</button>
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