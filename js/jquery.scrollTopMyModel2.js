$('a[href^="#toppestNav"]').on('click', function(event) { var target = $(this.getAttribute('href')); if( target.length ) { event.preventDefault(); $('#myModal2').stop().animate({ scrollTop: 0 }, 1000); } });
