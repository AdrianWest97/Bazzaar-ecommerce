
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
        Quantiy & price
      </div>
      <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="quantity">Quantity</label> 
          <input id="quantity" name="quantity" placeholder="How much do you have in stock?" type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') ?? $product->quantity}}"  autocomplete="quantity">
          @error('quantity')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-12 col-12">
          <label for="quantity">Weight</label> 
          <input id="weight" name="weight" placeholder="Product weight" type="number" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weught') ?? $product->weight }}"  autocomplete="weight">
          @error('weight')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
        <div class="col-lg-12 col-12">
          <label for="location" class="col-4">Unit</label> 
          <select id="unit" name="unit" class="custom-select custom-select-lg @error("unit") is-invalid @enderror" value="{{ old('unit') }}"  autocomplete="unit">
            <option value="kg">kg</option>
            <option value="g">g</option>
            <option value="lb">lb</option>
          </select>
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
{{-- 
      <div class="h5">
        Product images
       </div>
       <div class="row">
            @for ($i = 0; $i < 3; $i++)
            <div class="col-5">
            <label for="image{{$i}}">
                <input type="file" name="image{{$i}}" accept="image/*" id="image{{$i}}" class="form-control" style="display:none" />
                <img src={{isset($product->images[$i]) ? $product->get_small_image($product->images[$i]->image,"original") : asset('images/preview.png') }} class="img-fluid" id="image_preview_{{$i}}" />
              </label>
            </div>

            @endfor --}}
        </div>
