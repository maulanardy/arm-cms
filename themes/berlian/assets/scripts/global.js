var notif_card;

$(window).load(function() {
  $("#btn-next").tab("show");
});

notif_card = function() {
  $("html").addClass("notif-card-active");
  $(".notif-card").on("click", function() {
    $("html").removeClass("notif-card-active");
  });
  setTimeout((function() {
    $("html").removeClass("notif-card-active");
  }), 3000);
};

$(document).ready(function() {
  var $html, $window, footerThumbsInit, scrollTop, slickInit;
  $html = $('html');
  $window = $(window);
  scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  $window.on('scroll resize', function() {
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  });
  enquire.register('screen and (min-width:992px)', {
    match: function() {
      $('html').addClass('isDesktop');
    },
    unmatch: function() {
      $('html').removeClass('isDesktop');
    }
  });
  enquire.register('screen and (max-width:991px)', {
    match: function() {
      $('html').addClass('isMobile');
      $.fancybox.close();
    },
    unmatch: function() {
      $('html').removeClass('isMobile');
    }
  });
  $html.removeClass("no-js");
  $("#page-info").pageInfo({
    pre_class_name: ""
  });
  if ($html.hasClass('home')) {
    $html.headerSticky();
  } else {
    if ($('.content-wrap').length) {
      $html.headerSticky({
        window_h: $('.content-wrap').position().top
      });
    } else {
      $html.headerSticky({
        window_h: $('body').position().top
      });
    }
  }
  $("#pastnext-tab a").on("click", function(e) {
    e.preventDefault();
    $(this).tab("show");
  });
  $("#top-nav").dropMenu();
  $("#toggle-menu").toggleMenu({
    preContent: "<a href='/' class=''>" + $(".navbar-brand").html() + "</a>",
    postContent: "",
    cloneMenu: true,
    clickDesktop: false
  });
  $(".home-slide").slick({
    autoplay: true,
    autoplaySpeed: 7000,
    arrows: false,
    fade: true,
    cssEase: 'linear',
    appendDots: $('.slide-controls'),
    dots: true,
    dotsClass: 'dots',
    customPaging: function(slider, i) {
      var slideNumber, totalSlides;
      slideNumber = i + 1;
      totalSlides = slider.slideCount;
      return '<a class="dot" data-dots="' + i + '" role="button" title="' + slideNumber + ' of ' + totalSlides + '"></a>';
    }
  });
  $('.home-slide').on("beforeChange", function(event, slick, currentSlide, nextSlide) {
    $('.home-slide .slide li').each(function() {
      $(this).removeClass("active");
    });
  });
  $('.home-slide').on("afterChange", function(event, slick, currentSlide, nextSlide) {
    $('.home-slide .slide-controls li a').each(function() {
      var data_dots;
      data_dots = $(this).data("dots");
      if (data_dots === currentSlide) {
        $(this).parent().addClass("active");
      }
    });
  });
  $(".ourvideo-slides").slick({
    slidesToScroll: 1,
    slidesToShow: 1,
    arrows: true
  });
  slickInit = function() {
    $(".innertab-carousel").slick({
      adaptiveHeight: false,
      arrows: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      lazyLoad: 'ondemand',
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2
          }
        }, {
          breakpoint: 640,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    $('.arrow-prevnext > .prev').on("click", function() {
      $(".innertab-carousel").slick("slickPrev");
    });
    $('.arrow-prevnext > .next').on("click", function() {
      $(".innertab-carousel").slick("slickNext");
    });
  };
  slickInit();
  $('#pastnext-tab a').on('shown.bs.tab', function(e) {
    $('.innertab-carousel').slick('unslick');
    slickInit();
  });
  footerThumbsInit = function() {
    $("#footer-thumbs").slick({
      arrows: false,
      slidesToShow: 5,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 3
          }
        }
      ]
    });
  };
  footerThumbsInit();
  enquire.register('screen and (min-width: 768px)', {
    match: function() {
      $("#footer-thumbs").slick("unslick");
    },
    unmatch: function() {
      footerThumbsInit();
    }
  });
  $(".popup-login").fancybox({
    opts: {
      padding: 0
    }
  });
  $('.matchHeight').each(function() {
    $(this).children(".item").matchHeight({
      byRow: true
    });
  });
  $('.matchHeight-nowrap').children(".item").matchHeight({
    byRow: false
  });
  $('.matchHeight-autodetect').each(function() {
    var varProperty, varTarget;
    varTarget = $(this).data('match-target');
    varProperty = $(this).data('match-property');
    $(this).matchHeight({
      target: $(varTarget),
      property: varProperty
    });
  });
  $window.on('scroll resize', function() {
    if (scrollTop === 0) {
      $.fn.matchHeight._update();
    }
  });
  if ($('.dropdown-toggle').length) {
    $('.dropdown-toggle').dropdown();
  }
  $('.selectpicker').selectpicker();
  $('#toggle-menu-sticky').on('click', function() {
    $('html').toggleClass('open-menu-sticky');
  });
  $(".placeholder-animate").each(function() {
    var $this;
    $this = $(this);
    $this.find(".form-control").on("focus", function() {
      $this.addClass("active");
    });
    $this.find(".form-control").on("blur", function() {
      $this.removeClass("active");
    });
  });
  $("[data-show-notif_card]").on("click", function(e) {
    if (!$("html").hasClass("notif-card-active")) {
      notif_card();
    } else {
      return false;
    }
  });
});
