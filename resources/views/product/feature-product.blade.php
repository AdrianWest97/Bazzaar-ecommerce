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
<section id="section01" class="demo bg-white container">
    <div class="row p-5 m-5 justify-content-center">
        <p class="text-center">1 item(s) selected</p>
        <div class="d-flex flex-row bd-highlight text-dark">
            <div class="bd-highlight p-2">
                <i class="fa fa-check fa-lg text-success" aria-hidden="true"></i>
            </div>
            <div class="bd-highlight p-2">
                <img src={{$product->getImage('thumbnail')}} class="img-fluid img-thumbnail">
            </div>
            <div class="bd-highlight p-2">
                <h1 class="h1">{{$product->title}}</h1>
                <p>{{$product->description}}</p>
                <p>$ {{$product->price}}</p>
            </div>
        </div>
        
        <div class="col-3 text-right">
                <a href="#section02" class="baz-button">Select feature type</a>
            </div>
            
        </div>
</section>

<section id="section02" class="demo">
    <h1 class="text-center">Special offers</h1>
    
    <div class="row  p-5 m-5 bg-transparent">
        <div class="col-12 col-lg-3">
            <div class="card shadow-lg">
                <div class="card-header text-center border-0 bg-transparent">
                    <h1>Basic</h1>
                </div>
                <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item border-0 h2">
                        Free
                    </li>
                    <li class="list-group-item border-0">
                        One product
                    </li>
                    <li class="list-group-item border-0">
                        Display for 2 days
                    </li>
                </ul>
                
                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <form action="{{route('product.store.feature',['id'=>$product->id,'type'=>'basic'])}}" method="post">
                            @csrf
                        <input type="submit" value="Select"  class="btn btn-outline-secondary w-100 btn-lg"/>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12 col-lg-3">
            <div class="card shadow-lg">
                <div class="card-header text-center border-0 bg-transparent">
                    <h1><del>Standard</del></h1>
                </div>
                <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item border-0 h3">
                        $2.99 USD/ $410.00 JMD
                    </li>
                    <li class="list-group-item border-0">
                        Three (3) products
                    </li>
                    <li class="list-group-item border-0">
                        Display for 7 days
                    </li>
                </ul>
                
                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <button class="btn btn-outline-primary w-100 btn-lg disabled">Select</button>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-12 col-lg-3">
            <div class="card shadow-lg">
                <div class="card-header text-center border-0 bg-transparent">
                    <h1><del>Business</del></h1>
                </div>
                <div class="card-body">
                <ul class="list-group ">
                    <li class="list-group-item border-0 h3">
                        $10.99 USD/ $1,500 JMD
                    </li>
                    <li class="list-group-item border-0">
                        Three (7) products
                    </li>
                    <li class="list-group-item border-0">
                        Display for 30 days
                    </li>
                </ul>
                
                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <button class="btn btn-outline-primary w-100 btn-lg disabled">Select</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-3">
            <div class="card shadow-lg">
                <div class="card-header text-center border-0 bg-transparent">
                    <h1><del>Special</del></h1>
                </div>
                <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item border-0 h2">
                        Custom budget
                    </li>
                    <li class="list-group-item border-0">
                        Unlimited
                    </li>
                    <li class="list-group-item border-0">
                        Unlimited
                    </li>
                </ul>
                
                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <button class="btn btn-outline-success w-100 btn-lg disabled">Select</button>
                    </div>
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