  $(function(){

 
  function readURL(input, img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
          reader.onload = function (e) {
            $(img).hide().fadeIn("slow").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                            }
                  }
        
                $("#image0").change(function () {
-                      readURL(this, "#image_preview_0");
              });

              $("#image1").change(function () {
-                      readURL(this, "#image_preview_1");
              });

              $("#image2").change(function () {
-                      readURL(this, "#image_preview_2");
              });





$("#image0").change(function() {
  readURL(this,"#imagePreview0");
});


$("#image1").change(function() {
  readURL(this,"#imagePreview1");
});


$("#image2").change(function() {
  readURL(this,"#imagePreview2");
});





 });