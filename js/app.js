// jQuery noConflict Wrapper
jQuery(document).ready(function($) {


//************************************
// 
// Move skip links focus on Chrome and IE9
// 
//************************************

window.addEventListener("hashchange", function(event) {

    var element = document.getElementById(location.hash.substring(1));

    if (element) {

        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
            element.tabIndex = -1;
        }

        element.focus();
    }

}, false);


//************************************
// 
// Resize front page header block to window size
// 
//************************************

// var resizeWindow = function() {
//   if ( $(window).width() >= 640 ) {
//     if ( $('.front-page .site-header').height() < 343 ) {
//       $('.front-page .site-header').height(343);
//     } else {
//       $('.front-page .site-header').height($(this).height());
//     }
//   }
//   console.log( $('.front-page .site-header').height() );
// }
// resizeWindow();
// $(window).on('resize', resizeWindow);


//************************************
// 
// Scroll on page links
// 
//************************************

(function (jQuery) {
  jQuery.mark = {
    jump: function (options) {
      var defaults = {
        selector: 'a.scroll-on-page-link'
      };
      if (typeof options == 'string') {
        defaults.selector = options;
      }

      options = jQuery.extend(defaults, options);
      return jQuery(options.selector).click(function (e) {
        var jumpobj = jQuery(this);
        var target = jumpobj.attr('href');
        var thespeed = 1250;
        var offset = jQuery(target).offset().top;
        jQuery('html,body').animate({
          scrollTop: offset
        }, thespeed, 'swing');
        e.preventDefault();
      });
    }
  };
})(jQuery);

jQuery(function(){  
  jQuery.mark.jump();
});


//************************************
// 
// Parallax
// 
//************************************

$(document).ready(function() {
  if ($("#js-parallax-window").length) {
    parallax();
  }
});

$(window).scroll(function(e) {
  if ($("#js-parallax-window").length) {
    parallax();
  }
});

function parallax(){
  if( $("#js-parallax-window").length > 0 ) {
    var plxBackground = $("#js-parallax-background");
    var plxWindow = $("#js-parallax-window");

    var plxWindowTopToPageTop = $(plxWindow).offset().top;
    var windowTopToPageTop = $(window).scrollTop();
    var plxWindowTopToWindowTop = plxWindowTopToPageTop - windowTopToPageTop;

    var plxBackgroundTopToPageTop = $(plxBackground).offset().top;
    var windowInnerHeight = window.innerHeight;
    var plxBackgroundTopToWindowTop = plxBackgroundTopToPageTop - windowTopToPageTop;
    var plxBackgroundTopToWindowBottom = windowInnerHeight - plxBackgroundTopToWindowTop;
    var plxSpeed = 0.35;

    plxBackground.css('top', - (plxWindowTopToWindowTop * plxSpeed) + 'px');
  }
}


//************************************
// 
// Off-canvas navigation
// 
//************************************

$(document).ready(function(){
  $('.sliding-panel-button,.sliding-panel-fade-screen,.sliding-panel-close').on('click touchstart',function (e) {
    $('.sliding-panel-content,.sliding-panel-fade-screen').toggleClass('is-visible');
    var $expandedState = $('.sliding-panel-button');
    $expandedState.attr('aria-expanded',
        $expandedState.attr('aria-expanded') == 'false' ? 'true' : 'false'
      );
    e.preventDefault();
  });
});


//************************************
// 
// Normal tabs
// 
//************************************

$(document).ready(function () {
  $('.accordion-tabs').each(function(index) {
    $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
  });
  $('.accordion-tabs').on('click', 'li > a.tab-link', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $(this).closest('.accordion-tabs');
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      $(this).next().toggleClass('is-open').toggle();
      accordionTabs.find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });
});


//************************************
// 
// Minimal tabs
// 
//************************************

$(document).ready(function () {
  $('.accordion-tabs-minimal').each(function(index) {
    $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
  });

  $('.accordion-tabs-minimal').on('click', 'li > a', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $(this).closest('.accordion-tabs-minimal');
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      $(this).next().toggleClass('is-open').toggle();
      accordionTabs.find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });
});


//************************************
// 
// Vertical tabs
// 
//************************************

$(".js-vertical-tab-content").hide();
$(".js-vertical-tab-content:first").show();

/* if in tab mode */
$(".js-vertical-tab").click(function(event) {
  event.preventDefault();

  $(".js-vertical-tab-content").hide();
  var activeTab = $(this).attr("rel");
  $("#"+activeTab).show();

  $(".js-vertical-tab").removeClass("is-active");
  $(this).addClass("is-active");

  $(".js-vertical-tab-accordion-heading").removeClass("is-active");
  $(".js-vertical-tab-accordion-heading[rel^='"+activeTab+"']").addClass("is-active");
});

/* if in accordion mode */
$(".js-vertical-tab-accordion-heading").click(function(event) {
  event.preventDefault();

  $(".js-vertical-tab-content").hide();
  var accordion_activeTab = $(this).attr("rel");
  $("#"+accordion_activeTab).show();

  $(".js-vertical-tab-accordion-heading").removeClass("is-active");
  $(this).addClass("is-active");

  $(".js-vertical-tab").removeClass("is-active");
  $(".js-vertical-tab[rel^='"+accordion_activeTab+"']").addClass("is-active");
});


//************************************
// 
// Expanders
// 
//************************************

$(document).ready(function() {
  var expanderTrigger = document.getElementById("js-expander-trigger");
  var expanderContent = document.getElementById("js-expander-content");

  $('#js-expander-trigger').click(function(){
    $(this).toggleClass("expander-hidden");
  });
});


//************************************
// 
// Modals
// 
//************************************

$(function() {
  $("#modal-1").on("change", function() {
    if ($(this).is(":checked")) {
      $("body").addClass("modal-open");
    } else {
      $("body").removeClass("modal-open");
    }
  });

  $(".modal-fade-screen, .modal-close").on("click", function() {
    $(".modal-state:checked").prop("checked", false).change();
  });

  $(".modal-inner").on("click", function(e) {
    e.stopPropagation();
  });
});

// Auto show the modal on certain pages only
// $(document).ready(function () {
//   if( $("body").hasClass("front-page") ) {
//     $(".modal-state").prop("checked", true).change();
//   }
// });

// Auto show the modal on certain pages only and depending on cookie setting
// $(document).ready(function () {
//   if( $("body").hasClass("front-page") ) {
//     if( Cookies.get('pilot-modal') != 'true' ) {
//       Cookies.set('pilot-modal', 'true', { expires: 7, path: '/' });
//       $(".modal-state").prop("checked", true).change();
//     }
//   }
// });


//************************************
// 
// Add classes to Ninja Forms inline login
// and registration forms
// 
//************************************

$(document).ready(function () {
  // Add class to the resume progress login prompt that appears when user is not logged in
  $('div[id$=resume_link_wrap]').addClass('resume-login-prompt');

  // Add class to the login_form and register_form inline forms
  $('div[id$=login_form]').addClass('resume-login-form');
  $('div[id$=register_form]').addClass('resume-register-form');
});


	// close jQuery noConflict
});
//# sourceMappingURL=app.js.map