

<div class="row">
    @for ($i = 0; $i < 3; $i++)
    <div class="col-lg-5 col-12">
        <label for="image{{$i}}">
            <input type="file" name="image{{$i}}" accept="image/*" id="image{{$i}}" class="form-control" style="display:none" />
            <img src="{{asset('images/preview.png')}}" class="img-fluid " id="image_preview_{{$i}}" />
          </label>
    </div>
    @endfor
</div>
