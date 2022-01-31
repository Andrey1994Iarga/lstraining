'use strict';

$(function () {
  $('.lessons__slick').slick({
    slidesToShow: 4
  });

  $('nav').on('click', '.collapse', function () {
    $('body').toggleClass('min');
    return false;
  });

  $('.js-quiz').on('click', function () {
    $('.quiz__modal--overlay').toggleClass('active');
    $('body').toggleClass('active');
    return false;
  });

  $('.quiz__modal').on('click', '.close', function () {
    $('.quiz__modal--overlay').toggleClass('active');
    $('body').toggleClass('active');
  });

  $('.quiz__form').on('change', function () {
    $(this).find('.btn').removeAttr('disabled');
  });

  $('.quiz__form').on('change', '[type="text"]', function () {
    $(this).closest('.quiz__form').find('.btn').removeAttr('disabled');
  });

  $('.quiz__modal--overlay').on('click', '.btn', function () {
    $(this).closest('.quiz__modal--wrapper').removeClass('active').next('.quiz__modal--wrapper').addClass('active');
    if ($(this).closest('.quiz__modal--wrapper').next('.quiz__modal--wrapper').length == 0) {
      $('.quiz__modal--overlay').toggleClass('active');
      $('body').toggleClass('active');
      $($('.quiz__modal--wrapper')[0]).addClass('active');
    }
    return false;
  });

  var b = $(".sphere--big");
  var s = $(".sphere--small");
  var m = $(".move");
  $(".login").on("mousemove", function (t) {
    var e = -($(window).innerWidth() / 2 - t.pageX) / 30,
        n = ($(window).innerHeight() / 2 - t.pageY) / 20;
    b.attr("style", "transform: translate(" + e * -4 + "px, " + n * 2 + "px);");
    s.attr("style", "transform: translate(" + e * 3 + "px, " + n * -5 + "px);");
    m.attr("style", "transform: translate(" + e * 2 + "px, " + n * 1.5 + "px);");
  });

  $('.js-type__toggle').on('click', function () {
    $(this).prev('input').attr('type') == "text" ? $(this).prev('input').attr('type', 'password') : $(this).prev('input').attr('type', 'text');
  });
});
//# sourceMappingURL=app.js.map
