<form method="POST" class="p-0 m-0" id="regForm"  enctype="multipart/form-data" action="{{route('product.store')}}">
  @csrf
  @method('POST')
<div class="card p-0 m-0">
  <div class="card-header">
    Create new product
  </div>
  <div class="card-body">
    <input type="hidden" name="storeid" value="{{$store->id}}">
    <input type="hidden" name="type" value="car">

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
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
              <select class="form-control custom-select selectpicker" data-size="7" data-live-search="true" data-title="Parish" data-width="100%" name="location">
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
              <div class="form-group">
              <div class="col-12">
                <label for="model">Model</label> 
                <input id="model" name="model" placeholder="Vehicle model" type="text" class="@error('model') is-invalid @enderror" value="{{ old('model') }}"  autocomplete="model">
                @error('model')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
             @enderror
              </div>
              </div>
              <div class="form-group">
              <div class="col-12">
                <label for="year">year</label> 
                <input id="year" name="year" placeholder="Vehicle year" type="numeric" class="@error('year') is-invalid @enderror" value="{{ old('year') }}"  autocomplete="year">
                @error('year')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
             @enderror
              </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12 col-12">
                  <label for="transmission">Transmission type</label> 
                  <select id="transmission" name="transmission" class="selectpicker @error("transmission") is-invalid @enderror" data-size="7" data-live-search="true" data-title="transmission"  data-width="100%" value="{{ old('transmission') }}"  autocomplete="transmission">
                    <option value="Traditional Automatic Transmission">Automatic</option>
                    <option value="Automated-Manual ">Manual </option>
                    <option value="Tiptronic">Tiptronic</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12 col-12" style="margin-top:10px">
                    <label for="features">Additional features</label> 
                <input type="text" id="features" data-role="tagsinput" placeholder="Additional features seperated by comma" name="features" class="form-control @error('features') is-invalid @enderror" value="{{old('features')}}"  autocomplete="features" />
                @error('features')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                </div>
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

       
        <div style="overflow:auto" class="p-0">
          <div style="float:right;">
            <button type="button" class="btn btn-default theme-btn" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="btn btn-default theme-btn" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </div>
      
      
          </div>
          <div class="card-footer">     
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
          </div>
</div>
</form>
