@extends('layouts.store',['store'=>$data])

@section('store_content')
<section id="tabs" class="project-tab">
    <div class="container-fluid">

        <div class="row justify-content-between">
            <div class="col-6 text-left">
                <h3 style="font-weight:600">Products</h3>

            </div>
            <div class="col-2 text-right">
              <a  class="baz-button" href="{{route('product.create',['store'=>$data['store'],'product_type'=>'empty'])}}" role="button">Add product</a>
            </div>
           
        </div>
    
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-item" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Featured</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="tableProductList" class="card" style="padding:10px">

                            <table class="table table-hover table-borderless">

                                <thead class="bg-transparent">
                        
                                    <tr>
                                        {{-- <th >Edit</th> --}}
                                        <th >Image</th>
                                        <th >Product</th>
                                        <th >Type</th>
                                        <th >Description</th>
                                        <th>Cost</th>

                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($data['store']->products as $product)
                                    <tr class="border-bottom">
                                        {{-- <td>
                                            <a href="{{route('product.edit',['id'=>$product])}}">Edit</a>
                                        </td> --}}
                                        <td>
                                            <img src={{$product->getImage("thumbnail_smaller")}} class="img-fluid" style="max-width:60px;vertical-align:top;box-sizing:border-box" alt="Sheep">
                                        </td>
                                
                                        <td class="name" scope="row" class="w-auto">

                                            <span class="name"  style="vertical-align: middle; text-align:center">
                                                <a href="{{route('product.view',['product'=>$product])}}">
                                                 {{$product->title}}
                                                </a>
                                            </span>
                                        </td>

                                        <td class="w-auto" style="vertical-align: middle; text-align:center">
                                            {{$product->type}}
                                        </td>
                                        
                                        <td class="w-50"  style="vertical-align: middle;">
                                            {{$product->description}}
                                        </td>

                    
                                        <td  style="vertical-align: middle; text-align:center">
                                           $ {{$product->price}}
                                        </td>

                                    </tr> 
                                    @endforeach




                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    </div>
          
                </div>
            </div>
        </div>
    </div>
</section>

    @push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>

    <script>
        var pagingRows = 12;

        var paginationOptions = {
            innerWindow: 1,
            left: 0,
            right: 0
        };
        var options = {
            valueNames: ['name'],
            page: pagingRows,
            plugins: [ListPagination(paginationOptions)],
        };

        var tableProductList = new List('tableProductList', options);

        $('.jTablePageNext').on('click', function () {
            var list = $('.pagination').find('li');
            $.each(list, function (position, element) {
                if ($(element).is('.active')) {
                    $(list[position + 1]).trigger('click');
                }
            })
        })
        $('.jTablePagePrev').on('click', function () {
            var list = $('.pagination').find('li');

            $.each(list, function (position, element) {
                if ($(element).is('.active')) {
                    $(list[position - 1]).trigger('click');
                }
            })
        })



    </script>
    @endpush
@endsection