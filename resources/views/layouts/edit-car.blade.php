
<div class="col-lg-6 col-12">
        <div class="h5">
            Product information
          </div>
    {{-- <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="form_type" class="col-12">Product type</label> 
          <select id="form_type" name="type" class="custom-select">
            <option value="cars">Cars</option>
            <option value="electronic">Electronic</option>
            <option value="farm" selected>Farm</option>
            <option value="fashion">Fashion</option>
          </select>
        </div>
      </div> --}}
      <div class="form-group row">
        <div class="col-12">
          <label for="title">Tilte</label> 
          <input id="title" name="title" placeholder="Product title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $product->title}}"  autocomplete="title">
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
          <input id="name" name="vendor" value="{{Auth::user()->firstname}} {{Auth::user()->lastname}}" placeholder="Product vendor" type="text" class="form-control @error('vendor') is-invalid @enderror" value="{{ old('vendor') ?? $product->vendor}}"  autocomplete="vendor">
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
      <p><textarea id="description" placeholder="Product description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid @enderror"  autocomplete="description">{{ old('description') ?? $product->description}}</textarea>
        <span id="characterLeft" class="text-small"></span>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror</p>
    <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="tags" class="col-4">Tags</label> 
          <input id="tags" data-role="tagsinput"  name="tags" placeholder="Comma serperated" type="text" class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags') ?? $product->tags }}"  autocomplete="tags">
          @error('tags')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
      </div>
</div>


<div class="col-lg-6 col-12">
    <div class="h5">
      </div>
      <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="make">Make</label> 
          <input id="make" name="make" placeholder="veheicle make" type="text" class="form-control @error('make') is-invalid @enderror" value="{{ old('make') ?? $product->make}}"  autocomplete="make">
          @error('make')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="model">Model</label> 
          <input id="model" name="model" placeholder="veheicle model" type="text" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') ?? $product->model}}"  autocomplete="model">
          @error('model')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="year">Year</label> 
          <input id="year" name="year" placeholder="Year" type="text" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') ?? $product->year}}"  autocomplete="year">
          @error('year')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
      </div>

      <div class="form-group row">
      <div class="col-lg-12 col-12">
        <label for="transmission">Transmission type</label> 
        <select id="transmission" name="transmission" class="custom-select @error("transmission") is-invalid @enderror" value="{{ old('transmission') }}"  autocomplete="transmission">
          <option value="Traditional Automatic Transmission">Traditional Automatic Transmission</option>
          <option value="Automated-Manual ">Automated-Manual </option>
          <option value="Continuously Variable ">Continuously Variable </option>
          <option value="Dual-Clutch">Dual-Clutch</option>
          <option value="Direct Shift Gearbox">Direct Shift Gearbox</option>
          <option value="Tiptronic">Tiptronic</option>
        </select>
      </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="tags" class="col-4">Addtional features</label> 
          <input id="features" data-role="tagsinput"  name="features" placeholder="Comma serperated" type="text" class="form-control @error('features') is-invalid @enderror" value="{{ old('features') ?? $product->features ?? '' }}"  autocomplete="features">
          @error('features')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
      </div>


      <div class="form-group row">
        <div class="col-lg-8 col-12">
          <label for="price" class="col-4">price</label> 
          <input id="price" name="price" placeholder="Price" type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') ?? $product->price }}"  autocomplete="price">
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

      
