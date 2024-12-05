(function($) { 
"use strict"; 
    /*Images Loader*/
        $(window).on('load', function() {
        $('.images-preloader').fadeOut();
        });
    /* End Images Loader*/

    /*Add class current in menu*/
    $('ul .menu-item a').on('click',function() {
        $('.menu-item a').removeClass("current");
        $(this).addClass("current");
    });

    /*Cart Header*/
    $('body').on('click', function(event) {
        $(this).find('.site-header-cart .widget_shopping_cart').fadeOut();
    });
    $('.site-header-cart .cart-contents').on('click', function(event) {
        $(this).parent().find('.widget_shopping_cart').fadeToggle();
        event.stopPropagation(); 
    });
    $('.site-header-cart .widget_shopping_cart').on('click', function(event) {
        $(this).fadeIn();
        event.stopPropagation();
    });
    /*End Cart Header*/

    /*Header Scroll*/
    /*Fixed Navbar When Scroll*/
    var navbarFix = $("#js-navbar-fixed");
    var headerOffset = navbarFix.offset().top + 100;
    $(window).on('scroll',function () {
        if ($(window).scrollTop() > headerOffset) {
            navbarFix.addClass('fixed animated slideInDown').removeClass("unfixed");
        } else {
            navbarFix.addClass('unfixed').removeClass("fixed animated slideInDown");
        }
    });
    /*End Header Scroll*/

    /*Fixed Navbar When Scroll*/
    var mbnavbarFix = $("#js-navbar-mb-fixed");
    var headerOffsetmb = mbnavbarFix.offset().top + 80;
    $(window).on('scroll',function () {
        if ($(window).scrollTop() > headerOffsetmb) {
            mbnavbarFix.addClass('fixed animated slideInDown').removeClass("unfixed");
        } else {
            mbnavbarFix.addClass('unfixed').removeClass("fixed animated slideInDown");
        }
    });
    /*End Header Scroll*/

    /*Mobile Menu*/
    /*Hamburger Button*/
    $('.hamburger').on("click", function () {
        $(this).toggleClass("is-active");
        $('.au-navbar-mobile').slideToggle(200, 'linear');
    });

    /*Navbar menu dropdown*/
    $('.au-navbar-mobile .au-navbar-menu .drop .drop-link').on('click', function (e) {
        $(this).siblings('.drop-menu').slideToggle(200, 'linear');
        $(this).toggleClass('clicked');
        e.stopPropagation();
    });
    /*End Mobile Menu*/

    /*Back To Top Button*/
    $(window).on('scroll',function () {
        if ($(this).scrollTop() > 300) {
          $('#back-to-top').fadeIn('slow');
        } else {
          $('#back-to-top').fadeOut('slow');
        }
      });
    $('#back-to-top').on( 'click', function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });     
    /*End Back To Top Button*/

    /*CheckOut Page*/
    $(".checkout-section .woocommerce-form-login").hide();
    $(".showlogin").on('click',function(){
        $(".checkout-section .woocommerce-form-login").slideToggle();
    });

    $(".checkout_coupon").hide();
    $(".showcoupon").on('click',function(){
        $(".checkout_coupon").slideToggle();
    });

    $(".create-account").hide();
    $('[name="createaccount"]').on('click', function () {
        $('.create-account').slideToggle();
    });
    
    $('.payment_box').hide();
    $('[name="payment_method"]').on('click', function () {

        var $value = $(this).attr('value');

        $('.payment_box').slideUp();
        $('.payment_method_' + $value).slideToggle();

    });
    /*End CheckOut Page*/

    /*Shipping Calculator of Shop Cart Page*/
    $(".shipping-calculator-form").hide();
    $(".shipping-calculator-button").on('click',function(){
        $(".shipping-calculator-form").slideToggle();
    });
    /*End Shipping Calculator of Shop Cart Page*/

    /*noUiSlider*/
    var marginSlider = document.getElementById('slider-margin');
    if (marginSlider != undefined) {
        noUiSlider.create(marginSlider, {
            start: [ 8, 20 ],
            margin: 0,
            step: 1,
            connect: true,
            range: {
                'min': 8,
                'max': 26
            },
            format: {
                from: function(value) {
                        return parseInt(x,10);
                    },
                to: function(value) {
                        return parseInt(x,10);
                    }
            }
        });

        /*Show the slider value*/
        var marginMin = document.getElementById('value-lower'),
        marginMax = document.getElementById('value-upper');

        marginSlider.noUiSlider.on('update', function ( values, handle ) {
            if ( handle ) {
                marginMax.innerHTML = values[handle];
            } else {
                marginMin.innerHTML = values[handle];
            }
        });
    }
    /*End noUiSlider*/

    /*Featured Sale Section hp-1 --- change color og image*/
    $('.add_to_cart_button').on('mouseenter', function(){
        var currentSrc = $(this).find('img').attr('src');
        var activeSrc = currentSrc.replace('black','white');
        $(this).find('img').attr('src', activeSrc);
        console.log('mouseenter');
    });

    $('.add_to_cart_button').on('mouseleave', function(){
        var newSrc = $(this).find('img').attr('src');
        var oldSrc = newSrc.replace('white','black');
        $(this).find('img').attr('src', oldSrc);  
        console.log('mouseleave');    
    });
    /*End Featured Sale Section hp-1*/

    /*Scoll Silder Revolution hp-2*/
    $(".scroll-slider1").on('click', function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#arrivals-hp-2").offset().top
        }, 1000);
    });
    /*End Scoll Silder Revolution hp-2*/

    // Fancybox
    $('a.gallery-elements').fancybox({
        'transitionIn'  :   'elastic',
        'transitionOut' :   'elastic',
        'speedIn'       :   500, 
        'speedOut'      :   500, 
        'overlayShow'   :   false,
        'width'         : 937,
        'autoDimensions' : false,
        'centerOnScroll' : true
    });
    // End Fancybox

    /*Coming Soon Page*/
    $('#clock').countdown('2020/01/21').on('update.countdown', function(event) {
        var $this = $(this).html(event.strftime(''
        + '<p><span class="time">%-m</span> month%!m </p>'
        + '<p><span class="time">%d</span> day%!d </p>'
        + '<p><span class="time">%H</span> hours </p>'
        + '<p><span class="time">%M</span> mins </p>'
        + '<p><span class="time">%S</span> secs </p>'));
    });
    /*End Coming Soon Page*/

    /* Video*/
    $.fn.bmdIframe = function( options ) {
        var self = this;
        var settings = $.extend({
            classBtn: '.bmd-modalButton',
            defaultW: 640,
            defaultH: 360
        }, options );
      
        $(settings.classBtn).on('click', function(e) {
          var allowFullscreen = $(this).attr('data-bmdVideoFullscreen') || false;
          
          var dataVideo = {
            'src': $(this).attr('data-bmdSrc'),
            'height': $(this).attr('data-bmdHeight') || settings.defaultH,
            'width': $(this).attr('data-bmdWidth') || settings.defaultW
          };
          
          if ( allowFullscreen ) dataVideo.allowfullscreen = "";
          
          // stampiamo i nostri dati nell'iframe
          $(self).find("iframe").attr(dataVideo);
        });
      
        // se si chiude la modale resettiamo i dati dell'iframe per impedire ad un video di continuare a riprodursi anche quando la modale è chiusa
        this.on('hidden.bs.modal', function(){
          $(this).find('iframe').html("").attr("src", "");
        });
      
        return this;
    };
    jQuery("#modal-video").bmdIframe();
    /*End Video*/

    /* Countdown Timer Of hp-2*/
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }   

    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        if (clock != null) {
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');
            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
    }

    var deadline = new Date(Date.parse(new Date()) + 6 * 24 * 60 * 60 * 1000);
    initializeClock('clockdiv', deadline);
    /*End Countdown Timer Of hp-2*/

    /*Slider Revolution For Hp-1*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
        jQuery('#rev_slider_1').show().revolution({

            responsiveLevels: [1200, 992, 768, 576],
            autoHeight: 'on',
            sliderLayout: 'fullscreen',
                
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */         
            navigation: {

                arrows: {
 
                    enable: true,
                    style: 'hesperiden',
                    tmp: '',
                    rtl: false,
                    hide_onleave: false,
                    hide_onmobile: true,
                    hide_under: 992,
             
                    left: {
                        container: 'slider',
                        h_align: 'right',
                        v_align: 'bottom',
                        h_offset: 187,
                        v_offset: 38,
                    },
             
                    right: {
                        container: 'slider',
                        h_align: 'right',
                        v_align: 'bottom',
                        h_offset: 35,
                        v_offset: 38,
                    }
             
                },

                bullets: {
                    enable: true,
                    style: 'uranus',
                    tmp: '<span class="tp-bullet-inner"></span>',
                    hide_onleave: false,
                    h_align: "left",
                    v_align: "bottom",
                    h_offset: 50,
                    v_offset: 30,
                    space: 10,
                }
            }
        });   
    /*End Slider Revolution For Hp-1*/ 

    /*Slider Revolution For Hp-2 hp-6*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
        jQuery('#rev_slider_2').show().revolution({

            responsiveLevels: [1200, 992, 768, 576],
            autoHeight: 'on',
            sliderLayout: 'fullscreen',
                
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */         
            navigation: {

                arrows: {
 
                    enable: true,
                    style: 'hesperiden',
                    tmp: '',
                    rtl: false,
                    hide_onleave: false,
                    hide_onmobile: true,
                    hide_under: 576,

                    left: {
                        container: 'slider',
                        h_align: 'left',
                        v_align: 'center',
                        h_offset: 40,
                        v_offset: 0,
                    },
             
                    right: {
                        container: 'slider',
                        h_align: 'right',
                        v_align: 'center',
                        h_offset: 40,
                        v_offset: 0,
                    }
             
                },

                bullets: {
                    enable: false,
                }
            }
        });   
    /*End Slider Revolution For Hp-2 hp-6*/ 

    /*Slider Revolution For Hp-4*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
        jQuery('#rev_slider_4').show().revolution({

            responsiveLevels: [1200, 992, 768, 576],
             /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[1200, 992, 768, 576],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[776, 768, 960, 720],     

            navigation: {

                arrows: {
 
                    enable: true,
                    style: 'hesperiden',
                    tmp: '',
                    rtl: false,
                    hide_onleave: false,
                    hide_onmobile: true,
                    hide_under: 576,

                    left: {
                        container: 'slider',
                        h_align: 'left',
                        v_align: 'center',
                        h_offset: 0,
                        v_offset: 0,
                    },
             
                    right: {
                        container: 'slider',
                        h_align: 'right',
                        v_align: 'center',
                        h_offset: 0,
                        v_offset: 0,
                    }
             
                },

                bullets: {
                    enable: false,
                }
            }
        });   
    /*End Slider Revolution For Hp-4*/ 

    /*Testimonials Section of hp-1*/
    $('#testimonials-hp-1').owlCarousel({
        items:1,
        loop:true,
        margin: 0,
        nav:true,
        navText: [ 
            "<span class='lnr lnr-chevron-left'></span>",
            "<span class='lnr lnr-chevron-right'></span>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });
    /*End Testimonials Section of hp-1*/

    /*Arrivals Section hp-2*/
    $('#arrivals-left').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-long-arrow-left'></i>",
            "<i class='zmdi zmdi-long-arrow-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });

    $('#arrivals-right').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });
    /*End Arrivals Section hp-2*/

    /*Best Sellers Section hp-2*/
    $('#seller-left').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });

    $('#seller-right').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-long-arrow-left'></i>",
            "<i class='zmdi zmdi-long-arrow-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });
    /*End Best Sellers Section hp-2*/

    /*List Section hp-6*/
    $('#list-1').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });
    $('#list-2').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });
    $('#list-3').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1
                
            },
            992:{
                items:1
            }
        }
    });
    /*End List Section hp-6*/

    /* Shop Single v1*/
    $('#related-products').owlCarousel({
        items:4,
        loop: false,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:2
                
            },
            768:{
                items:3
                
            },
            1200:{
                items:4
            }
        }
    });

    $('#best-seller').owlCarousel({
        items:4,
        loop: false,
        margin: 30,
        nav:true,
        navText: [ 
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:2
                
            },
            768:{
                items:3
                
            },
            1200:{
                items:4
            }
        }
    });
    /*End /* Shop Single v1*/

    /*Owl Carousel Image Thumbnails hp-5*/
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: false,
        items: 1,
        thumbs: true,
        thumbImage: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item'
    });
    /*End Owl Carousel Image Thumbnails hp-5*/

    /* Play video 01 Of Audio Post Page*/
    $.fn.bmdIframe = function( options ) {
        var self = this;
        var settings = $.extend({
            classBtn: '.bmd-modalButton',
            defaultW: 640,
            defaultH: 360
        }, options );
      
        $(settings.classBtn).on('click', function(e) {
          var allowFullscreen = $(this).attr('data-bmdVideoFullscreen') || false;
          
          var dataVideo = {
            'src': $(this).attr('data-bmdSrc') + "?autoplay=1",
            'height': $(this).attr('data-bmdHeight') || settings.defaultH,
            'width': $(this).attr('data-bmdWidth') || settings.defaultW
          };
          
          if ( allowFullscreen ) dataVideo.allowfullscreen = "";
          
          // stampiamo i nostri dati nell'iframe
          $(self).find("iframe").attr(dataVideo);
        });
      
        // se si chiude la modale resettiamo i dati dell'iframe per impedire ad un video di continuare a riprodursi anche quando la modale è chiusa
        this.on('hidden.bs.modal', function(){
          $(this).find('iframe').html("").attr("src", "");
        });
      
        return this;
    };
    var mediaElements = document.querySelectorAll('audio');

    for (var i = 0, total = mediaElements.length; i < total; i++) {
        new MediaElementPlayer(mediaElements[i], {
            features: ['prevtrack', 'playpause', 'nexttrack', 'current', 'progress', 'duration', 'volume', 'playlist', 'shuffle', 'loop', 'fullscreen'],
        });
    }
    jQuery("#modal-video-01").bmdIframe();

})(jQuery);

function Increase(){
    var x = document.getElementById("quantity").value;//lay gia tri cu trong text
    if(parseInt(x, 10) > 0){
        document.getElementById("quantity").value = parseInt(x, 10) +1;// + gia tri lay dc len 1 roi gan kq vao o text
    }
}
function Decrease(){
    var x = document.getElementById("quantity").value;
    if(parseInt(x, 10) > 1){
        document.getElementById("quantity").value = parseInt(x, 10) -1;
    }
}

function Increase2(){
    var y = document.getElementById("quantity_02").value;//lay gia tri cu trong text
    if(parseInt(y, 10) > 0){
        document.getElementById("quantity_02").value = parseInt(y, 10) +1;// + gia tri lay dc len 1 roi gan kq vao o text
    }
}
function Decrease2(){
    var y = document.getElementById("quantity_02").value;
    if(parseInt(y, 10) > 1){
        document.getElementById("quantity_02").value = parseInt(y, 10) -1;
    }
}
