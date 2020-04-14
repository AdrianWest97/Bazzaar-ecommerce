
<form method="POST" id="regForm" enctype="multipart/form-data" action="{{route('product.store')}}">
    @csrf
    <input type="hidden" name="storeid" value="{{$data['store']->id}}">
    <input type="hidden" name="type" value="farm">

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
          <div class="h5">
            Product information
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label for="title">Tilte</label> 
              <input id="title" name="title" placeholder="Product title" type="text" class=" @error('title') is-invalid @enderror" value="{{ old('title') }}"  autocomplete="title">
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
              <label for="location" class="col-4">Location</label> 
              <select id="location" name="location" class="custom-select @error("location") is-invalid @enderror" value="{{ old('location') }}"  autocomplete="location">
                <option value="kingston">Kingston</option>
                <option value="manchester">Manchester</option>
                <option value="St. James">St. James</option>
              </select>
            </div>
          </div>
        </div>

        <div class="tab">
          <div class="h5">
            Product description
          </div>
          <p><textarea id="description" placeholder="Product description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"  autocomplete="description"></textarea>
            <span id="characterLeft" class="text-small"></span>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror</p>

        <div class="form-group row">
          <div class="col-lg-12 col-12">
            <label for="tags" class="col-4">Tags</label> 
            <input id="tags" name="tags" placeholder="Comma serperated" type="text" class="@error('tags') is-invalid @enderror" value="{{ old('tags') }}"  autocomplete="tags">
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
            Quantiy & price
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-12">
              <label for="quantity">Quantity</label> 
              <input id="quantity" name="quantity" placeholder="How much do you have in stock?" type="number"class="@error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"  autocomplete="quantity">
              @error('quantity')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-10 col-12">
              <label for="quantity">Weight</label> 
              <input id="weight" name="weight" placeholder="Product weight" type="number"class="@error('weight') is-invalid @enderror" value="{{ old('weught') }}"  autocomplete="weight">
              @error('weight')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
            <div class="col-lg-2 col-12">
              <label for="location" class="col-4">Unit</label> 
              <select id="unit" name="unit" class="custom-select custom-select-lg @error("unit") is-invalid @enderror" value="{{ old('unit') }}"  autocomplete="unit">
                <option value="kg">kg</option>
                <option value="g">g</option>
                <option value="lb">lb</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-12">
              <label for="price" class="col-4">price</label> 
              <input id="price" name="price" placeholder="Price" type="text" class="@error('price') is-invalid @enderror" value="{{ old('price') }}"  autocomplete="price">
              @error('price')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
          </div>
        </div>

        <div class="tab">
          <div class="h5">
           Product images
          </div>
          @include('layouts.image-upload')
        </div>
        
       
        <div style="overflow:auto;">
          <div style="float:right;">
            <button type="button" class="baz-button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="baz-button" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </div>
       
        
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
        
        </form>