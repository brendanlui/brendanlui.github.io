$('a[href^="#"]').on('click', function(event) { var target = $(this.getAttribute('href')); if( target.length ) { event.preventDefault(); $('html, body').stop().animate({ scrollTop: 0 }, 1000); } });
