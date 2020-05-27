@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">


  Dropzone.options.dropzone =
   {
      maxFilesize: 12,
      renameFile: function(file) {
          var dt = new Date();
          var time = dt.getTime();
         return time+file.name;
      },
      acceptedFiles: ".jpeg,.jpg,.png,.webp",
      addRemoveLinks: true,
      timeout: 5000,
      removedfile: function(file) 
            {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ url("image/delete") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
       
      success: function(file, response) 
      {
          console.log(response);
      },
      error: function(file, response)
      {
         return false;
      }
};

</script>
@endpush

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<style>
 .dropzone {
    border: 2px dashed lightgray;
    border-radius: 5px;
    background: white;
}
  </style>
@endpush

@extends('layouts.store')
@section('store_content')



<div class="row m-1 justify-content-center">
<div class="col-12 col-lg-10">
  <div class="card">
    <div class="card-header">Upload clean, good quality product image</div>
    <div class="card-body">
      <form method="post"
      action="{{route('image.upload',['product'=>$product])}}"
       enctype="multipart/form-data" 
         class="dropzone p-5" 
         id="dropzone">
     @csrf
   </form> 
    </div>
    <div class="card-footer text-muted border-0 bg-transparent">
      <form action="{{route('product.save',['product'=>$product])}}" method="post">
        @csrf
        @method('put')
      <input name="submit" class="baz-button right" type="submit" value="Finish">
      </form>
    </div>
  </div>
</div>
</div>
  


@endsection
