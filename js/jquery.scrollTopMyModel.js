$('a[href^="#toppest"]').on('click', function(event) { var target = $(this.getAttribute('href')); if( target.length ) { event.preventDefault(); $('#myModal').stop().animate({ scrollTop: target.offset().top }, 1000); } });
