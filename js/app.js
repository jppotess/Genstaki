// jQuery noConflict Wrapper
jQuery(document).ready(function($) {


// Make Menu responsive with icon

  // Add a.menuButton icon button area to widget-header
    $('<a href="#" class="menuButton"><span></span></a>').insertBefore( 'nav.nav-primary' );

  // add open class to nav icon
    $('a.menuButton').click(function() {
        $( this ).toggleClass( 'open' );
        // slide toggle display:none to make visible

        $('.nav-secondary').slideToggle( 'slow');

    });


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



	// close jQuery noConflict
});
//# sourceMappingURL=app.js.map