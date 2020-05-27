


$(function(){

  var maxChars = 255;
  var textLength = 0;
  var comment = "";
  var outOfChars = 'You have reached the limit of ' + maxChars + ' characters';

  /* initalize for when no data is in localStorage */
  var count = maxChars;
  $('#characterLeft').text(count + ' characters left');

  /* fix val so it counts carriage returns */
  $.valHooks.textarea = {
    get: function(e) {
      return e.value.replace(/\r?\n/g, "\r\n");
    }
  };

  function checkCount() {
    textLength = $('textarea').val().length;
    if (textLength >= maxChars) {
      $('#characterLeft').text(outOfChars);
    }
    else {
      count = maxChars - textLength;
      $('#characterLeft').text(count + ' characters left');
    }
  }

  /* on keyUp: update #characterLeft as well as count & comment in localStorage */
  $('textarea').keyup(function() {
    checkCount();
    comment = $(this).val();
    localStorage.setItem("comment", comment);
  });

  /* on pageload: get check for comment text in localStorage, if found update comment & count */
  if (localStorage.getItem("comment") != null) {
    $('#comment').text(localStorage.getItem("comment"));
    checkCount();
  }

  let menu = document.querySelector(".menu");
let button = document.querySelector(".menu__button");

toggleMenu = () => {
  menu.classList.toggle("open");
}

button.addEventListener("click", function() {
  clearInterval(interactionPreview);
  toggleMenu();
});

let interactionPreview = setInterval(() => {
  toggleMenu();
}, 2000);


});


//Open dropdown when clicking on element
$(document).on('click', "a[data-dropdown='notificationMenu']",  function(e){
  e.preventDefault();
  
  var el = $(e.currentTarget);
  
  $('body').prepend('<div id="dropdownOverlay" style="background: transparent; height:100%;width:100%;position:fixed;"></div>')
  
  var container = $(e.currentTarget).parent();
  var dropdown = container.find('.dropdown');
  var containerWidth = container.width();
  var containerHeight = container.height();
  
  var anchorOffset = $(e.currentTarget).offset();

  dropdown.css({
    'right': containerWidth / 2 + 'px'
  })
  
  container.toggleClass('expanded')
  
});

//Close dropdowns on document click

$(document).on('click', '#dropdownOverlay', function(e){
  var el = $(e.currentTarget)[0].activeElement;
  
  if(typeof $(el).attr('data-dropdown') === 'undefined'){
    $('#dropdownOverlay').remove();
    $('.dropdown-container.expanded').removeClass('expanded');
  }
})

//Dropdown collapsile tabs
$('.notification-tab').click(function(e){
  if($(e.currentTarget).parent().hasClass('expanded')){
    $('.notification-group').removeClass('expanded');
  }
  else{
    $('.notification-group').removeClass('expanded');
    $(e.currentTarget).parent().toggleClass('expanded');
  }
})


//add to cart function
function addTocart(id){
     $.get('/add-to-cart/'+id,function(resp){
      var v = parseInt($("#cartcount").text()) || 0;
      v++;
      $("#cartcount").fadeIn("slow").text(v);
      Toastify({
        text: "Cart updated!",
        duration: 3000, 
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: 'left', // `left`, `center` or `right`
        backgroundColor: "rgb(142,199,61)",
        stopOnFocus: true, // Prevents dismissing of toast on hover
        onClick: function(){} // Callback after click
      }).showToast();
     });
}