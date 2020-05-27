@extends('layouts.app')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <style>
        body{
            background-color: rgb(240,240,240) !important
        }
        </style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
      // https://paulund.co.uk/smooth-scroll-to-internal-links-with-jquery
$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash;
	    var $target = $(target);
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        // window.location.hash = target;
	    });
    });


    
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());


});
 </script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-12 p-5">
        <ul class="list-group">
            <li class="list-group-item">
                <div class="d-flex flex-lg-row flex-column bd-highlight text-dark">
                    <div class="bd-highlight p-2">
                        <img src={{$product->getImage('medium')}} class="img-fluid rounded img-thumbnail">
                    </div>
                    <div class="bd-highlight p-2">
                        <div class="d-flex flex-column bd-highlight text-dark">
                        <p>{{$product->title}}</p>
                        <p>{{$product->description}}</p>

                    </div>
                    </div>
                   
                </div>
            </li>
        
        </ul>

    
        </div>
    </div>
</div>


<section class="container-fluid">
    <h1 class="text-center">Special offers</h1>

    <div class="container">
        <div class="card-deck mx-auto m-5 text-center ">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h3 class="my-0 font-weight-normal">Basic</h3>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">$0</h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li>1 product selection</li>
                  <li>Only for 2 days</li>
                  <li>Minimum analytics</li>
                  <li>unlimited user views</li>
                </ul>
                <form method="POST" action="{{route('product.store.feature',['id'=>$product->id,'type'=>'basic'])}}">
                    @csrf
                    @method('POST')

                <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Select for free</button>
              </div>
            </div>
            <div class="card mb-4 shadow-lg">
              <div class="card-header bg-transparent border-0">
                <h3 class="my-0 font-weight-normal">Stabdard</h3>
                <small>Recommened</small>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">$2.99<small class="text-muted">/ $410JMD</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>3 product selections</li>
                    <li>Only for 7 days</li>
                    <li>Maximum analytics</li>
                    <li>unlimited user views</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">Buy now</button>
              </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h3 class="my-0 font-weight-normal">Business</h3>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">$10.99<small class="text-muted">/ $1,500JMD</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Up to 7 product display</li>
                    <li>Only for 30 days</li>
                    <li>Maximum analytics</li>
                    <li>unlimited user views</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">Buy now</button>
              </div>
            </div>
          </div>  


    </div>
</section>


{{-- <section id="section03" class="demo container">
    <h1 class="text-center">Start date</h1>
    <div class="row  p-5 m-5 bg-transparent justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="form-group">
                <label>Select Date: </label>
                <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                    <input class="form-control" type="text" readonly />
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="">Special display title</label>
                <input type="text" name="display-title" id="" class="form-control custom-input" placeholder="" aria-describedby="helpId">
              </div>
              <div class="form-group">
                <div class="col-5 float-right">
                    <a href="#section02" class="baz-button">Finish</a>
                </div>
                </div>
        </div>
 
    </div>
    
</section> --}}

@endsection
@section('footer')
@include('layouts.footer')
@endsection
