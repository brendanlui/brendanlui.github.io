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
if(isset($_GET['category_name'])) {
	$category_name = $_GET['category_name'];
}else{
	$category_name = "";
}
if(isset($_GET['time_name'])) {
	$time_name = $_GET['time_name'];
}else{
	$time_name = "";
}
if(isset($_GET['artist_name'])) {
	$keyword_name = $_GET['artist_name'];
	$artist_name = $_GET['artist_name'];
}else{
	$keyword_name = "";
	$artist_name = "";
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
<link id="stylecall" rel="stylesheet" href="/movie_yes_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_yes_pre_style.css" />
<link id="stylecall" rel="stylesheet" href="/loading_img_style.css" />

<body>	
	<div id="page0">
		<a id="toppest" class="smooth"></a>
	</div>
	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>	
	</a>
	</div>

	
	<link rel="stylesheet" type="text/css" href="to_top_not_immediate_movie_pre.css">
	<div id="head">
		<div id="nav">
			 <ul>
				 <a id="myBtn" href="/movie" class="subtitle" style="display: block;">View all</a>
			 </ul>
		</div>
	</div>

	
	<div id="pre_movie_title">
		<h2>New Arrivals</h2>
	</div>
	
	<link id="stylecall" rel="stylesheet" href="/drop_list_style.css" />
	<div class="dropdown">
		<button class="dropbtn">
			<?php
				if($sort == "")
					echo"Sort";
				else{
					if(strcmp($sort,'photo')==0)
						echo 'by Name';
					elseif(strcmp($sort,'date')==0)
						echo 'by Date';
					elseif(strcmp($sort,'duration')==0)
						echo 'by Duration';
					elseif(strcmp($sort,'viewcount')==0)
						echo 'by View';
				}
			?>
		</button>
		<div class="dropdown-content" style="left:0;">
			<a href="/movie_pre.php?sort=&category_name=<?php echo $category_name; ?>&time_name=<?php echo $time_name;?>" class="sort_button">All</a>
			<a href="/movie_pre.php?sort=photo&category_name=<?php echo $category_name; ?>&time_name=<?php echo $time_name;?>" class="sort_button">by Name</a>
			<a href="/movie_pre.php?sort=date&category_name=<?php echo $category_name; ?>&time_name=<?php echo $time_name;?>" class="sort_button">by Date</a>
			<a href="/movie_pre.php?sort=duration&category_name=<?php echo $category_name; ?>&time_name=<?php echo $time_name;?>" class="sort_button">by Duration</a>
			<a href="/movie_pre.php?sort=viewcount&category_name=<?php echo $category_name; ?>&time_name=<?php echo $time_name;?>" class="sort_button">by View</a>
	  </div>
	</div>

	<div class="dropdown">
		<button class="dropbtn">
			<?php
				if($category_name == "")
					echo"Category";
				else
					echo ucfirst($category_name);
			?>
		</button>
		<div class="dropdown-content" style="left:0;">
		<?php
			echo('<a href="/movie_pre.php?sort='.$sort.'&time_name='.$time_name.'" class="sort_button">All</a>');
			$category = array('anal', 'blowjob' ,'group','hentai','incest', 'lesbian', 'rape' ,'sm','uncensored');
			for($i = 0; $i < sizeof($category); $i++){
				echo('<a href="/movie_pre.php?sort='.$sort.'&category_name='.$category[$i].'&time_name='.$time_name.'" class="sort_button">'.ucfirst($category[$i]).'</a>');
			}
			echo('<a href="/movie_pre_category.php?sort='.$sort.'&time_name='.$time_name.'" class="sort_button">more...</a>');
		?>	
	  </div>
	</div>	
	
	<div class="dropdown">
		<button class="dropbtn">
			<?php
				if($time_name == "")
					echo"Time";
				else
					echo ucfirst($time_name);
			?>
		</button>
		<div class="dropdown-content" style="left:0;">
			<a href="/movie_pre.php?sort=<?php echo $sort; ?>&category_name=<?php echo $category_name; ?>" class="sort_button">All</a>
			<a href="/movie_pre.php?sort=<?php echo $sort; ?>&category_name=<?php echo $category_name; ?>&time_name=daily" class="sort_button">Daily</a>
			<a href="/movie_pre.php?sort=<?php echo $sort; ?>&category_name=<?php echo $category_name; ?>&time_name=weekly" class="sort_button">Weekly</a>
			<a href="/movie_pre.php?sort=<?php echo $sort; ?>&category_name=<?php echo $category_name; ?>&time_name=monthly" class="sort_button">Monthly</a>
			<a href="/movie_pre.php?sort=<?php echo $sort; ?>&category_name=<?php echo $category_name; ?>&time_name=yearly" class="sort_button">Yearly</a>
	  </div>
	</div>		

	<div class="dropdown">
		<button class="dropbtn">
			<?php
					echo"Artist";
			?>
		</button>
		<div class="dropdown-content" style="left:0;">
		<?php
			echo('<a href="/movie_pre.php" class="sort_button">All</a>');
			$artist = array('JULIA','RION','三上悠亞','三原穗香','佐佐木'
						,'吉澤明步','園田'
						,'明日花'
						,'椎名'
						,'水野朝陽','波多野');
						
			$artist_eng = array('JULIA','RION','Mikami Yua','Honoka Mihara','Sasaki Nozomi'
			,'Yoshizawa Akiho','Mion Sonoda'
			,'Kirara Asuka'
			,'Sora Shiina'
			,'Asahi Mizuno','Hatano Yui');
			
			$artist_chi = array('JULIA','RION','三上悠亞','三原穗香','佐佐木明希'
			,'吉澤明步','園田美櫻'
			,'明日花綺羅'
			,'椎名空'
			,'水野朝陽','波多野結衣');

			for($i = 0; $i < sizeof($artist); $i++){
				echo('<a href="/movie_pre.php?artist_name='.$artist[$i].'" class="sort_button">'.$artist_chi[$i].'</a>');
			}
			echo('<a href="/movie_pre_artist.php" class="sort_button">more...</a>');
		?>	
	  </div>
	</div>	
	
	<form method="GET" action="movie_pre.php">
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
			data_url 		: 'pre_movie_fetch_pages.php?sort=' + <?php echo json_encode($sort); ?> + '&keyword_name=' + <?php echo json_encode($keyword_name); ?>+ '&category_name=' + <?php echo json_encode($category_name)?>+ '&time_name=' + <?php echo json_encode($time_name) ; ?>, //url to PHP page
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