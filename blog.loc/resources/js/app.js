require('./bootstrap');

//slider
$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        nav: true,
        margin: 10,
        loop: true,
        autoplay: true,
        dots: false,
        responsive:{
            0:{
                items:1,
            },
            640:{
                items:2,
            },
            950:{
                items:3,
            }
        }
    });
});
