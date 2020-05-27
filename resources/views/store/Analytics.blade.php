
@extends('layouts.store')
@section('store_content')
@push( 'scripts' )
    <script src="{{asset('js/chartjs/jquery.min.js' )}}"></script>

    <script src="{{asset( 'js/chartjs/Chart.min.js' )}}" defer></script>

    <script src="{{asset( 'js/create-charts.js' )}}" defer></script>
    @endpush
    <div class="container-fluid">
        <div class="h4">Store Analytics</div>
        <nav class="navbar navbar-light bg-transparent">
            <a class="navbar-brand" href="#">Your store got {{$store->getViewsForPastdays($period)}} views in the last {{$period}} days</a>
            <span class="navbar-text">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select period  <i class="feather-16 feather-inline" data-feather="calendar"></i></span>

                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{route('store.analytics',['store'=>$store,'period'=>7])}}">Last 7 days</a>
                      <a class="dropdown-item" href="{{route('store.analytics',['store'=>$store,'period'=>28])}}">Last 28 days</a>
                      <a class="dropdown-item" href="{{route('store.analytics',['store'=>$store,'period'=>90])}}">Last 90 days</a>
                      <a class="dropdown-item" href="{{route('store.analytics',['store'=>$store,'period'=>365])}}">Last 365 days</a>
                    </div>
                  </div>
              </span>
        </nav>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 col-6">
              <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of products</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$store->products->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="feather-32 feather-inline" data-feather="shopping-cart"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 col-6">
              <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Req for the last {{$period}} days</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="feather-32 feather-inline" data-feather="clipboard"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4 col-6">
              <div class="card border-left-info shadow-sm h-100 py-2 rounded">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total subscribers</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col">
                          {{-- <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 col-6">
              <div class="card border-left-warning shadow-sm h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="feather-32 feather-inline" data-feather="trello"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="section">
        <div class="section__content col-12">
            <div class="section-title">
              </div>

                    <div class="card p-3">
                        <div class="card-header bg-transparent border-0 text-center">
                                                            <!-- As a link -->
                           
                   
                        </div>


                        <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="30"></canvas>
                        </div>
                    </div>
                </div>
        </div>

        <div class="section mt-5">
            <div class="section__content">
                <div class="section-title">
                    <div class="h4">Your top products in this period</div>
                    <input type="hidden" id="storeid" value="{{$store->id}}"/>
                    <input type="hidden" id="period" value="{{$period}}"/>
                </div>
                @if ($store->topProducts()!=null && $store->topProducts()->count() > 0)
             
                        <div id="tableProductList" class="card" style="padding:10px">
                        <table class="table table-hover table-borderless">

                            <thead class="bg-transparent">
                    
                                <tr>
                                    {{-- <th >Edit</th> --}}
                                    <th ></th>
                                    <th class="text-center">Views</th>

                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($store->topProducts() as $product)
                                @if (views($product)->unique()->count() > 0)
                                    
                                <tr class="border-bottom">

                                    <td scope="row">
                                        <a class="text-dark display-5" href="{{route('product.view',['product'=>$product])}}">

                                        <div class="d-flex flex-row">
                                            <div class="order-3 p-2 bd-highlight"><img src={{$product->getImage("medium")}} class="img-fluid" style="">
                                            </div>
                                            <div class="order-3 p-2 bd-highlight">
                                                    <div class="d-flex flex-column">
                                                    <div class="bd-highlight">
                                                        {{$product->title}}
                                                    </div>
                                                    <div class="bd-highlight">
                                                        {{Carbon\Carbon::parse($product->created_at)->format("M d, yy")}}
                                                    </div>
                                                    <div class="bd-highlight">
                                                        {{$product->reviews->count()}} reviews
                                                    </div>
                                                    
                                                    </div>
                                            </div>


                                        </div>
                                        </a>
                                        
                                            
                                        
                                    </td>

                                    <td class="w-auto" style="vertical-align: middle; text-align:center">
                                        {{views($product)->unique()->count()}}
                                    </td>
                                    
                                </tr> 
                                @endif

                                @endforeach




                            </tbody>
                        </table>
                        </div>                
                    @else
                    <div class="card text-dark shadow-sm-none bg-white p-5 text-center" style="border:3px dashed rgb(228,230,234)">
                        <div class="card-body">
                          <h4 class="card-title h5">No products available</h4>
                          <p class="card-text"> 
                           <i class="fa fa-plus" aria-hidden="true"></i>
                            <a href="{{route('product.create',['store'=>$store,'product_type'=>'empty'])}}"> Add products</a>
                           </p>
                        </div>
                      </div>
                @endif

        @endsection
