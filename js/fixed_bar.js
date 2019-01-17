$(document).ready(function() {
  
  $(window).scroll(function () {
      //if you hard code, then use console
      //.log to determine when you want the 
      //nav bar to stick.  
      console.log($(window).scrollTop())
    if ($(window).scrollTop() > 230 &&($(window).scrollTop() + $(window).height() < $(document).height() -30)) {
      $('#nav_bar').addClass('navbar-fixed');
    }
    if ($(window).scrollTop() < 231) {
      $('#nav_bar').removeClass('navbar-fixed');
    }
  });
});
