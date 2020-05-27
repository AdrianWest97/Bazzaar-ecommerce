
@extends('layouts.store')
@push("css")
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.css"/>
<style>
    table {
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  /* text-align: center; */
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
    </style>
@endpush
@push("scripts")
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
    $('.product-list').DataTable();
});

function showDeleteModal(id){
    $('#exampleModal').modal('show');
    var pid = $("#product_id").val(id);

}
</script>
@endpush
@section('store_content')
<section id="tabs" class="project-tab">
    <div class="container-fluid">

        <div class="row justify-content-between">
            <div class="col-6 text-left">
                <h3 style="font-weight:600">Products</h3>

            </div>
            <div class="col-lg-2 text-right">
              <a  class="btn btn-default theme-btn" href="{{route('product.create',['store'=>$store,'product_type'=>'empty'])}}" role="button">Add product <i data-feather="plus"></i></a>
            </div>
           
        </div>
    
        <div class="row">
            <div class="col-md-12 col-12">
                <nav>
                    <div class="nav nav-tabs nav-item" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Featured</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="tableProductList" class="card border bg-white p-lg-5">

                            <table class="table table-borderless table-hover product-list">

                                <thead class="bg-transparent">
                        
                                    <tr>
                                        {{-- <th >Edit</th> --}}
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Type</th>
                                        {{-- <th >Description</th> --}}
                                        <th scope="col">Cost</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($store->products()->orderby("created_at","desc")->get() as $product)
                                    <tr>
                                        {{-- <td>
                                            <a href="{{route('product.edit',['id'=>$product])}}">Edit</a>
                                        </td> --}}
                                        <td data-label="Image">
                                            <img src={{$product->getImage("thumbnail")}} class="img-fluid" style="" alt="prodyct image">
                                            @featured($product)
                                            <span class="badge badge-success">Feature</span>
                                            @endfeatured
                                        </td>
                                
                                        <td data-label="Title">

                                            <span class="name"  style="vertical-align: middle; text-align:center">
                                                <a href="{{route('product.view',['product'=>$product])}}" class="text-dark h6">
                                                 {{$product->title}}
                                                </a>
                                            </span>
                                        </td>

                                        <td data-label="Product type">
                                            {{$product->type}}
                                        </td>
                                        
                                        {{-- <td class="w-50"  style="vertical-align: middle;">
                                            {{$product->description}}
                                        </td> --}}

                    
                                        <td data-label="Price">
                                           @convert($product->price){{$product->currency}}
                                        </td>

                                        <td data-label="Action">

                                          <div class="dropdown">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                 Option
                                                </button>
                                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                              <a href="javascript:;" onclick="showDeleteModal({{$product->id}})" class="dropdown-item" aria-hidden="true"><i class="feather-16 feather-inline text-danger" data-feather="trash"></i> Delete product</a>
                                              <a href="{{route('product.edit',['store'=>$store,'product'=>$product])}}" class="dropdown-item" aria-hidden="true"><i class="feather-16 feather-inline text-primary" data-feather="edit-2"></i> Edit product</a>
                                              @featured($product)
                                              <a href="{{route('remove.featured',['id'=>$product->id])}}" class="dropdown-item" aria-hidden="true"><i class="feather-16 feather-inline text-danger" data-feather="x"></i> Remove AD</a>
                                              @else
                                              <a href="{{route('product.feature',['id'=>$product->id])}}" class="dropdown-item" aria-hidden="true"><i class="feather-16 feather-inline" data-feather="gift"></i> Add to featured</a>
                                              @endfeatured
                                            </div>
                                          </div>
 
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('product.destroy')}}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" name="product_id" id="product_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this product?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
        </form>
    </div>
  </div>
  
@endsection