<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php include 'config_logined.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/register_style.css" />
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link id="stylecall" rel="stylesheet" href="/logined_style.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
</head>

<title>Dadiu | Item</title>

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
<link id="stylecall" rel="stylesheet" href="/dispear_sort_search.css" />
  <nav id='nav_bar'>
    <ul class='nav_links'>
	
	
	
	   <li class="fix_bar_li" id="fix_bar_search">
			<form target="iframe1" class="search_bar" method="GET" action="logined_next_iframe_sort_left.php">
				<input type="text" id="myInput" name="keyword_name" placeholder="Search">
				<button type="submit" id="search_button"><img id="search_button_img" src="/img/search_icon.png" style="width:20px; height:20px;"></button>
			</form>	   
	   </li>	
	   
	<link id="stylecall" rel="stylesheet" href="/icon_in_bar_style.css" />
	  <li class="fix_bar_li" id="fix_bar_list">
			<div class="dropdown" id="sort_in_next" style="float:left;">
				<button class="dropbtn"><img class="icon_in_bar" src="/img/sort.png"></button>
				<div class="dropdown-content" style="left:0;">
					<a target="iframe1" href="/logined_next_iframe_sort_left.php" class="sort_button">View All</a>
					<a target="iframe1" href="/logined_next_iframe_sort_left.php?sort=resolved" class="sort_button">by status</a>
					<a target="iframe1"href="/logined_next_iframe_sort_left.php?sort=reward" class="sort_button">by rewards</a>
					<a target="iframe1"href="/logined_next_iframe_sort_left.php?sort=title" class="sort_button">by name</a>
					<a target="iframe1"href="/logined_next_iframe_sort_left.php?sort=date" class="sort_button">by time</a>
					<a target="iframe1"href="/logined_next_iframe_sort_left.php?sort=caller" class="sort_button">by caller</a>			
			  </div>
			</div>	  
	  </li> 
	  
	  
	  
	  
	  <li class="fix_bar_li" id="fix_bar_list">
			<div class="dropdown" style="float:left;">
				<button class="dropbtn"><img class="icon_in_bar" src="/img/account.png"></button>
				<?php
				$num_unread = 0;
				include 'config_database_value.php';
				$con=mysqli_connect($servername, $username, $password, $dbname);
				mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar

				// Check connection
				if (mysqli_connect_errno())
				{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}

				$result = mysqli_query($con,"SELECT * FROM database_notice ORDER BY date DESC");


				while($row = mysqli_fetch_array($result))
				{
					if(strcmp($row['object'], $_SESSION['username']) == 0 && strcmp($row['read_or_unread'], 'Unread') == 0){
						$num_unread++;
					}
				}
				if($num_unread > 0){
					echo '
					<link id="stylecall" rel="stylesheet" href="/num_of_notice_style.css" />
					<span class="num_of_notice">'.$num_unread.'</span>
					
					';
				}
				mysqli_close($con);
				?>					

				<div class="dropdown-content" style="left:0;">
					<a href="/logined_new_post.php"class="sort_button">New</a>	
					<a href="/logined_my_post.php"class="sort_button">My Post</a>					
					<a href="/logined_my_job.php"class="sort_button">My Job</a>	
					<a href="/logined_notice.php"class="sort_button">Notice</a>	
					<a href="logout.php"class="sort_button">SignOut</a>	
			  </div>
			</div>	  
	  </li> 
    </ul>
  </nav>

<link id="stylecall" rel="stylesheet" href="/logined_iframe_style.css" />
<div class="container_left">	
	<iframe class="iframe_left" name="iframe1" src="/logined_next_iframe_left.php" >
	</iframe>
</div>

<div class="container_right">	
	<iframe class="iframe_right" name="iframe2" src="/logined_next_iframe_right.php?id=<?php echo$_GET["id"]?>">
	</iframe>
</div>

	
</body>

</html>