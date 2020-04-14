
<form method="POST" id="regForm"  enctype="multipart/form-data" action="{{route('product.store')}}">
    @csrf
    <input type="hidden" name="storeid" value="{{$data['store']->id}}">
    <input type="hidden" name="type" value="car">

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
                Vehicle details
              </div>
              <div class="col-12">
                <label for="make">Make</label> 
                <input id="make" name="make" placeholder="Vehicle make" type="text" class="@error('make') is-invalid @enderror" value="{{ old('make') }}"  autocomplete="make">
                @error('make')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
             @enderror
              </div>
              <div class="col-12">
                <label for="model">Model</label> 
                <input id="model" name="model" placeholder="Vehicle model" type="text" class="@error('model') is-invalid @enderror" value="{{ old('model') }}"  autocomplete="model">
                @error('model')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
             @enderror
              </div>
              <div class="col-12">
                <label for="year">year</label> 
                <input id="year" name="year" placeholder="Vehicle year" type="numeric" class="@error('year') is-invalid @enderror" value="{{ old('year') }}"  autocomplete="year">
                @error('year')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
             @enderror
              </div>
                <div class="col-lg-12 col-12">
                  <label for="transmission" class="col-4">Transmission type</label> 
                  <select id="transmission" name="transmission" class="custom-select @error("transmission") is-invalid @enderror" value="{{ old('transmission') }}"  autocomplete="transmission">
                    <option value="Traditional Automatic Transmission">Traditional Automatic Transmission</option>
                    <option value="Automated-Manual ">Automated-Manual </option>
                    <option value="Continuously Variable ">Continuously Variable </option>
                    <option value="Dual-Clutch">Dual-Clutch</option>
                    <option value="Direct Shift Gearbox">Direct Shift Gearbox</option>
                    <option value="Tiptronic">Tiptronic</option>
                  </select>
                </div>
                <div class="col-lg-12 col-12" style="margin-top:10px">
                    <label for="features" class="col-4">Additional features</label> 
              <textarea id="features" placeholder="Additional features" name="features" cols="40" rows="5" class="form-control @error('features') is-invalid @enderror" value="{{ old('features') }}"  autocomplete="features"></textarea>
              <span id="characterLeft" class="text-small"></span>
                @error('features')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                </div>
        </div>

        <div class="tab">
          <div class="h5">
            Overview description
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-12">
          <textarea id="description" placeholder="Product description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"  autocomplete="description"></textarea>
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
          Pricing
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
  
       
       
        <div style="overflow:auto" class="p-5">
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
          <span class="step"></span>
        </div>
        
        </form>