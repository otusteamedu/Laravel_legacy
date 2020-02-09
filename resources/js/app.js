require('./bootstrap');

jQuery(document).ready(function( $ ) {

    // Menu settings
    $('#menuToggle, .menu-close').on('click', function(){
        $('#menuToggle').toggleClass('active');
        $('body').toggleClass('body-push-toleft');
        $('#theMenu').toggleClass('menu-open');
    });

    // Smooth scroll for the menu and links with .scrollto classes
  $('.smoothscroll').on('click', function(e) {
    e.preventDefault();
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {

        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1500, 'easeInOutExpo');
      }
    }
        $('body').toggleClass('body-push-toleft');
        $('#theMenu').toggleClass('menu-open');
  });

// Animate on scroll
if( $('#grid').length) {
  new AnimOnScroll(document.getElementById('grid'), {
    minDuration: 0.4,
    maxDuration: 0.7,
    viewportFactor: 0.2
  });
}

if( $('#process').length) {
  new AnimOnScroll(document.getElementById('process'), {
    minDuration: 0.4,
    maxDuration: 0.7,
    viewportFactor: 0.2
  });
}

});
