$(document).ready(function () {

  booksLiderInit();

  function booksLiderInit() {
    var item = $('.bookSlider__item');
    var itemWidth = $(item[0]).width();
    var count = item.length;
    var allItem = itemWidth * count;
    var block = $('.bookSlider');
    var blockWidth = $('.bookSlider').outerWidth(true);
    var maxItemBlock = Math.floor(blockWidth / itemWidth);

    if (blockWidth < allItem) {
      $('.bookSlider').slick({
        slidesToShow: maxItemBlock,
        infinite: false,
      });
    }

  }

  $('.burgerMenu').on('click', function () {
    $(this).toggleClass('active');

    if ($(this).hasClass('active')){
      bgPopup(true);
      $('.header').css('display', 'inline-block');
      setTimeout(function () {
        $('.header').css('left', '0');
      }, 200)
    } else {
      $('.header').css('left', '-270px');
      setTimeout(function () {
        $('.header').css('display', 'none');
      }, 200)
      bgPopup(false);
    }
  });


  $(document).on('click','.backgroundPopup', function () {
    bgPopup(false);
    $('.burgerMenu').removeClass('active');
    $('.header').css('left', '-270px');
    setTimeout(function () {
      $('.header').css('display', 'none');
    }, 200);
  });

  function bgPopup(status) {
    if (status) {
      var overflow = $('<div>').addClass('backgroundPopup');
      $('body').append(overflow);
    } else {
      $(document).find('.backgroundPopup').remove();
    }
  }

});