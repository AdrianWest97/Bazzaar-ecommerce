
<form method="POST" class="p-0 m-0" id="regForm"  enctype="multipart/form-data" action="{{route('product.store')}}">
  @csrf
  @method('post')
  <div class="card p-lg-0 m-lg-0">
    <div class="card-header">
      Create new product
    </div>
    <div class="card-body">
    <input type="hidden" name="storeid" value="{{$store->id}}">
    <input type="hidden" name="type" value="electronic">

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
          <div class="h5">
            Product information
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label for="title">Title</label> 
              <input id="title" name="title"  placeholder="Product title" type="text" class=" @error('title') is-invalid @enderror" value="{{ old('title') }}"  autocomplete="title">
              @error('title')
                 <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
              </span>
           @enderror
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label for="vendor">Vendor</label> 
              <input id="name" name="vendor" value="{{Auth::user()->firstname}} {{Auth::user()->lastname}}" placeholder="Product vendor" type="text" class="@error('vendor') is-invalid @enderror" value="{{ old('vendor') }}"  autocomplete="vendor">
              @error('vendor')
                 <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
              </span>
           @enderror
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-12">
              <label for="location">Location</label> 
              <select class="form-control custom-select" name="location">
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
            </div>
          </div>
        </div>



        <div class="tab">
          <div class="h5">
            Overview description
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label for="brand">Brand</label> 
              <input id="brand" name="brand" placeholder="Product brand" type="text" class="@error('brand') is-invalid @enderror" value="{{ old('brand') }}"  autocomplete="brand">
              @error('vendor')
                 <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
              </span>
           @enderror
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
          <textarea id="description" placeholder="Product description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description') }}</textarea>
          <span id="characterLeft" class="text-small"></span>
          @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
            </div>
          </div>
        <div class="form-group row">
          <div class="col-lg-12 col-12">
            <label for="tags">Tags</label> 
            <input id="tags" data-role="tagsinput" name="tags" placeholder="Comma serperated" type="text" class="@error('tags') is-invalid @enderror" value="{{ old('tags') }}"  autocomplete="tags">
            @error('tags')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          </div>
        </div>
        </div>

        <div class="tab">
          <div class="h5">
          Pricing
          </div>
          <div class="form-group row">
            <div class="col-lg-8 col-12">
              <label for="price"></label> 
              <input id="price" name="price" placeholder="Price" type="text" class="@error('price') is-invalid @enderror" value="{{ old('price') }}"  autocomplete="price">
              @error('price')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
            <div class="col-lg-4 col-12">
              <label for="currency">Currency</label> 
              <select id="currency" name="currency" class="custom-select">
                <option value="JMD">JMD</option>
                <option value="USD">USD</option>
              </select>
            </div>
          </div>
        </div>

        {{-- <div class="tab">
          <div class="h5">
           Product images
          </div>
            @include('layouts.image-upload')
            
          </div> --}}
  
       
       
        <div style="overflow:auto">
          <div style="float:right;">
            <button type="button" class="btn btn-default theme-btn" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="btn btn-default theme-btn" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </div>
      
    </div>
        <!-- Circles which indicates the steps of the form: -->
        <div class="card-footer">
        <div style="text-align:center">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
        </div>
        
        </form>