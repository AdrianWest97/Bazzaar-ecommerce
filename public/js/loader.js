$('body').show();

NProgress.start();

setTimeout(function() { NProgress.done();
    
     $('.faded').removeClass('out'); }, 1000);