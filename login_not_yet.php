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
<html lang="en">
<head>

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/register_style.css" />
	<link id="stylecall" rel="stylesheet" href="/logined_style.css" />
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<title>Dadiu | Home</title>
</head>
<style>
    body{line-height:1;}
</style>

<body>
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" style="width:300px;height:240px;">
		</div>
	</a>
	</div>
	<div class="first_words">Here you can order everything!</div>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/js/fixed_bar.js"></script>
<link id="stylecall" rel="stylesheet" href="/fixed_bar.css" />
  <nav id='nav_bar'>
    <ul class='nav_links'>
	   <li class="fix_bar_li" id="fix_bar_search" >
			<form class="search_bar" method="GET" action="logined.php" >
				<input type="text" id="myInput" name="keyword_name" placeholder="Search">
				<button type="submit" id="search_button"><img id="search_button_img" src="/img/search_icon.png" style="width:20px; height:20px;"></button>
			</form>  
	   </li>	

		<link id="stylecall" rel="stylesheet" href="/icon_in_bar_style.css" />
	  <li class="fix_bar_li" id="fix_bar_list">
			<div class="dropdown" style="float:left;">
				<button class="dropbtn"><img class="icon_in_bar" src="/img/sort.png"></button>
				<div class="dropdown-content" style="left:0;">
					<a href="/logined.php" class="sort_button">View All</a>
					<a href="/logined.php?sort=resolved" class="sort_button">Status</a>
					<a href="/logined.php?sort=reward" class="sort_button">Rewards</a>
					<a href="/logined.php?sort=title" class="sort_button">Name</a>
					<a href="/logined.php?sort=date" class="sort_button">Time</a>
					<a href="/logined.php?sort=caller" class="sort_button">Caller</a>		
			  </div>
			</div>	  
	  </li> 
	
	  <li class="fix_bar_li" id="fix_bar_list">
			<div class="dropdown" style="float:left;">
				<button class="dropbtn"><img class="icon_in_bar" src="/img/account.png"></button>				
				<div class="dropdown-content" style="left:0;">
					<a href="/logined_new_post.php"class="sort_button">New</a>	
					<a href="/logined_my_post.php"class="sort_button">My Post</a>					
					<a href="/logined_my_job.php"class="sort_button">My Job</a>	
					<a href="/logined_notice.php"class="sort_button">Notice</a>			
					<a href="/logined.php"class="sort_button">Login</a>	
			  </div>
			</div>	  
	  </li> 
    </ul>
  </nav>
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
			data_url 		: 'pre_login_fetch_pages.php?sort=' + <?php echo json_encode($sort); ?> + '&keyword_name=' + <?php echo json_encode($keyword_name); ?>, //url to PHP page
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