$(function(){

  "use strict";

  // reload if layout needs to be refreshed (home-version2.html)
  window.onorientationchange = function() {
    var orientation = window.orientation;
    if( $('.carousel-container').length>0 ){
      switch(orientation) {
        case 0:
        case 90:
        case -90: window.location.reload();
        break;
      }
    }
  };

  ////// parallax elements starts
  if ($(window).width() > 768) {
    $('.parallax-block, .pricing-banner').parallax("50%", -0.6);
    $('.pricing-banner').parallax("50%", 1.3);
    $('.block1').parallax("50%", -0.2);
    $('.block2').parallax("50%", -0.2);
    $('.block3').parallax("50%", -0.2);
    $('.block4').parallax("50%", -0.2);
    $('.block5').parallax("50%", -0.2);
    $('.block6').parallax("50%", -0.2);
    $('.block7').parallax("50%", -0.2);
  }

  ////// Wow Script starts
  var wow = new WOW({
    animateClass: 'animated',
    offset: 100,
    callback: function(box) {

    }
  });
  wow.init();

  //////scroll function for changed css starts
  $(window).scroll(function() {
    // if ($(this).scrollTop() > 0) {
    //   jQuery(".wrapper>header").addClass("scrolled");
    // } else {
    //   jQuery(".wrapper>header").removeClass("scrolled");
    // }
    if ($(this).scrollTop() > 600) {
      jQuery("footer").css({"z-index": "1"});
    } else {
      jQuery("footer").css({"z-index": "0"});
    }
  });

  //////show loader image on loading starts
  $(".se-pre-con").fadeOut("slow");

  ///// testimonial bx slider starts
  $('.bxslider').bxSlider({
    minSlides: 1,
    maxSlides: 1,
    slideMargin: 0,
    mode: 'fade',
    speed: 1000,
    easing: 'swing',
    auto: true
  });

  ///// sucess slider
  $('.sucess-slide').bxSlider({
    auto: true,
    pager: false,
    controls: true,
    prevText : '<i class="fa fa-angle-left"></i> Prev ',
    nextText : 'Next <i class="fa fa-angle-right"> </i>'
  });

  ///// home banner starts
  $("#owl-demo").owlCarousel({
  autoPlay: 4000, //Set AutoPlay to 3 seconds
  transitionStyle: "fade",
  items: 1,
  itemsDesktop: [1199, 1],
  itemsDesktopSmall: [979, 1],
  itemsMobile: [768, 1]

  });

  ///// featured menu carousel slider starts
  var lw = 600;
  var lh = 388;
  var sw = 495;
  var sh = 320;
  var sp = 10;
  var so = 30;
  var tp = 10;

  var $width = $(window).width();
  if($width < 1200 && $width > 992){
    lw = 500;
    lh = 288;
    sw = 295,
    sh = 220,
    sp = 10,
    so = 30,
    tp = 10;
  } else if($width < 993 && $width >= 769){
    lw = 400;
    lh = 258;
    sw = 205,
    sh = 180,
    sp = 10,
    so = 30,
    tp = 10;
  } else if($width <= 768 && $width > 400){
    lw = 250;
    lh = 180;
    sw = 195,
    sh = 120,
    sp = 10,
    so = 30,
    tp = 10;
  } else if($width <= 400 ){
    lw = 200;
    lh = 150;
    sw = 195,
    sh = 120,
    sp = 10,
    so = 15,
    tp = 20;
  }

  var carousel = $("#carousel").featureCarousel({
    largeFeatureWidth : lw,
    largeFeatureHeight : lh,
    smallFeatureWidth : sw,
    smallFeatureHeight : sh,
    sidePadding : sp,
    smallFeatureOffset : so,
    topPadding : tp
  });

  ///////menu toggle starts
  $("a,div,button, span").on('click',function(e){

    if ( $(this).hasClass("navbar-toggle") ) {

      $(".collapse").slideToggle("500");

    }else if ( $(this).hasClass("radio-btn") ) {

      $('.radio-btn').removeClass('checked');
      var obj = $(this);
      var thisInput = obj.find('.radio-class');
      thisInput.prop("checked", true);
      obj.addClass("checked");

    }else if ( $(this).is("#myTabs") ) {

      e.preventDefault()
      $(this).tab('show')
    }else if ( $(this).is("#but_prev") ) {

      carousel.prev();
    }else if ( $(this).is("#but_pause") ) {

      carousel.pause();
    }else if ( $(this).is("#but_start") ) {

      carousel.start();
    }else if ( $(this).is("#but_next") ) {

      carousel.next();
    }else if ( $(this).is("#play-btn") ) {

      var video = document.getElementById('bg-video');
      var $video = $('#bg-video');
      var $control = $('#play-btn');
      if(video.paused == true){
        video.play();
        $('.video-bg').hide();
        $control.parents('.video-controls').fadeTo(500, 0).css({'z-index':0}).addClass('hidden');
        $video.parents('.video-wrap').addClass('hide-bg-overlay');
      } else {
        video.pause();
        $control.parents('.video-controls').fadeTo(10, 1).css({'z-index':1}).removeClass('hidden');
        $video.parents('.video-wrap').removeClass('hide-bg-overlay');
      }
      e.preventDefault();




    }else if ( $(this).is("#bg-video") ) {

      var $video = $('#bg-video');
      var $control = $('#play-btn');
      if(video.paused == false){
        $control.parents('.video-controls').fadeTo(10, 1).css({'z-index':1}).removeClass('hidden');
        video.pause();
        $video.parents('.video-wrap').removeClass('hide-bg-overlay');
      } else {
        $control.parents('.video-controls').fadeTo(500, 0).css({'z-index':0}).addClass('hidden');
        video.play();
        $video.parents('.video-wrap').addClass('hide-bg-overlay');
      }
    }else if( $(this).is('.altera')){
       // Increases or decreases the value being 0 as low as possible
      var inputScope =  $(this).parent('td').find (".txtacrescimo");
      if ($(this).hasClass('acrescimo'))
         inputScope.val(parseInt(inputScope.val())+1);
      else if (inputScope.val()>=1)
          inputScope.val(parseInt(inputScope.val())-1);
    }
  });

  ///// featured menu bx slider starts
  if ($(window).width() > 768) {
    $('.bxslider1').bxSlider({
      minSlides: 4,
      maxSlides: 4,
      adaptiveHeight: true,
      slideWidth: 270,
      slideMargin: 0,
      speed: 1000,
      easing: 'swing',
      auto: true
    });
  }
  else {

    $('.bxslider1').bxSlider({
      minSlides: 1,
      maxSlides: 1,
      adaptiveHeight: true,
      slideWidth: 270,
      slideMargin: 0,
      speed: 1000,
      easing: 'swing',
      auto: true
    });
  };

  //remove class if browser is IE starts
  var ms_ie = false;
  var ua = window.navigator.userAgent;
  var old_ie = ua.search('MSIE ');
  var new_ie = ua.search('Trident/');

  if ((old_ie > -1) || (new_ie > -1)) {
    ms_ie = true;
  }

  if ( ms_ie ) {
    $('body *').removeClass('hvr-wobble-horizontal');
    $('body *').removeClass('hvr-wobble-vertical');
  }

  //remove class if browser is IE ends
  if(navigator.appVersion.indexOf("MSIE 9.") != -1){
    $("html").addClass("ie9");
  } else if(navigator.appVersion.indexOf("MSIE 8.") == 8){
    $("html").addClass("ie8");
  }

  $(".sidebar-widget li").addClass("wow fadeInRight");

  // Element cache to avoid constant search cycles by the same
  var $input = $('.txtacrescimo');

  // Set 0 to start
  $input.val(1);



  //range slider
  $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000,
      values: [ 0, 800 ],
      slide: function( event, ui ) {
        $( "#amount" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );


  //counter
  $('.counter').counterUp({
      delay: 10,
      time: 1000
  });



});

//accordion
$(function() {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.link');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el;
      $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('.detail').not($next).slideUp().parent().removeClass('open');
    };
  }

  var accordion = new Accordion($('.acdn'), false);
});
