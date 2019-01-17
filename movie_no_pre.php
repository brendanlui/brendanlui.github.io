<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php
if(isset($_GET['sort'])) {
	$sort = $_GET['sort'];
}else{
	$sort = "";
}
if(isset($_GET['keyword_name'])) {
	$keyword_name = $_GET['keyword_name'];
}else{
	$keyword_name = "";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
</head>

<title>Dadiu | New Arrivals</title>

<link id="stylecall" rel="stylesheet" href="/movie_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_no_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_no_pre_style.css" />
<link id="stylecall" rel="stylesheet" href="/loading_img_style.css" />

<body>	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>
	</a>		
	</div>

	<link rel="stylesheet" type="text/css" href="to_top_not_immediate.css">
	<div id="head">
		<div id="nav">
			 <ul>
				 <a id="myBtn" href="/movie_no" class="subtitle" style="display: block;">View all</a>
			 </ul>
		</div>
	</div>
	
	<div id="pre_movie_title">
		<h2>New Arrivals</h2>
	</div>	
		
	<a href="/movie_no_pre.php?sort=photo" class="button">by Name</a>
	<a href="/movie_no_pre.php?sort=date" class="button">by Date</a>
	<a href="/movie_no_pre.php?sort=duration" class="button">by Duration</a>
	<a href="/movie_no_pre.php?sort=viewcount" class="button">by View</a>
	
	
	<form method="GET" action="movie_no_pre.php">
		<input type="text" id="myInput" name="keyword_name" placeholder="Search by name">
		<button type="submit" id="search_button"><img id="search_button_img" src="/img/search_icon.png"></button>
	</form>
	
<ul class="list">
	<div class="list_of_source" id="list_id">
		<!-- results appear here as list -->
	</div>
</ul>	

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript">
(function($){	
	$.fn.loaddata = function(options) {// Settings
		var settings = $.extend({ 
			loading_gif_url	: "ajax-loader_transparent_black_eat.gif", //url to loading gif
			end_record_text	: '', //no more records to load
			data_url 		: 'pre_movie_no_fetch_pages.php?sort=' + <?php echo json_encode($sort); ?> + '&keyword_name=' + <?php echo json_encode($keyword_name); ?>, //url to PHP page
			start_page 		: 1 //initial page
		}, options);
		
		var el = this;	
		loading  = false; 
		end_record = false;
		contents(el, settings); //initial data load
		
		$(window).scroll(function() { //detact scroll
			if($(window).scrollTop() + $(window).height() >= $(document).height() - 800){ //scrolled to bottom of the page
				contents(el, settings); //load content chunk 
			}
		});		
	}; 
	//Ajax load function
	function contents(el, settings){
		var load_img = $('<img/>').attr('src',settings.loading_gif_url).addClass('loading-image'); //create load image
		var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info'); //end record text
		
		if(loading == false && end_record == false){
			loading = true; //set loading flag on
			el.append(load_img); //append loading image
			$.post( settings.data_url, {'page': settings.start_page}, function(data){ //jQuery Ajax post
				if(data.trim().length == 0){ //no more records
					el.append(record_end_txt); //show end record text
					load_img.remove(); //remove loading img
					end_record = true; //set end record flag on
					return; //exit
				}
				
				setTimeout(function() {	//set time delay for load image
							loading = false;  //set loading flag off
							load_img.remove(); //remove loading img 
							el.append(data);  //append content 
							settings.start_page ++; //page increment
				}, 250);
					
				

			})
		}
	}

})(jQuery);

$("#list_id").loaddata();
</script>


</body>

</html>