<?php

if(isset($_GET['sort'])) {
	$sort = $_GET['sort'];
	if($sort == "")
		$sort = "date";
	$prepare_value = "SELECT id, video, photo, duration, size, date, state, fee, viewcount FROM database_movie_no ORDER BY ".$sort." DESC LIMIT ?, ?";
}
$keyword_name = "";
if(isset($_GET['keyword_name'])){
	$keyword_name = $_GET['keyword_name'];
}

include 'config_database_value.php';
if($keyword_name == "")
	$item_per_page = 10;
else
	$item_per_page = 10000000;

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($mysqli, "utf8"); //view the chinese word in sql with Nvarchar
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
    header('HTTP/1.1 500 Invalid page number!');
    exit;
}

//get current starting point of records
$position = (($page_number-1) * $item_per_page);
//fetch records using page position and item per page. 
$results = $mysqli->prepare($prepare_value);	

//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
//for more info https://www.sanwebe.com/2013/03/basic-php-mysqli-usage
if($results){

	$results->bind_param("dd", $position, $item_per_page); 
	$results->execute(); //Execute prepared Query
	$results->bind_result($id, $video, $photo, $duration, $size, $date, $state, $fee, $viewcount); //bind variables to prepared statement

	//output results from database
	while($results->fetch()){ //fetch values
		if(strtolower($keyword_name) == ""){
			$photo_base = explode(".", $photo);
			array_pop($photo_base);
			$photo_base = implode('.', $photo_base);

			echo '
						<div class="item" category="" style="display:block;">
								<table class="item_table"><tbody>
								<tr>
									<td>
										<div class="img_container">
											<a href="/movie_next.php?url=/video2/'.$video.'&title='.$photo_base.'&id='.$id.'">
												<img src="/video2/'.$photo.'" class="small_video_img"></img>
											</a>
										</div>
										<div class="filter_border">
											<a href="/movie_next.php?url=/video2/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
												'.$photo_base.'
											</a>
										</div>
										<div class="detail">
											<div class="hour">'.$duration.'</div>&nbsp;
											<div class="size">'.$size.'</div></br>
											<div class="viewcount">View: '.$viewcount.'</div>
											<div class="date">'.$date.'</div>&nbsp;
											<div class="promo">'.$state.'</div>&nbsp
											<div class="price">'.$fee.'</div>
											
										</div>
									</td>
								</tr>
								</tbody></table><li id="thisisid'.$id.'"></li>
						</div>'; 
		}else{
			
			if (strpos(strtolower($photo), strtolower($keyword_name)) !== false) {
			$photo_base = explode(".", $photo);
			array_pop($photo_base);
			$photo_base = implode('.', $photo_base);

			echo '
						<div class="item" category="" style="display:block;">
								<table class="item_table"><tbody>
								<tr>
									<td>
										<div class="img_container">
											<a href="/movie_next.php?url=/video2/'.$video.'&title='.$photo_base.'&id='.$id.'">
												<img src="/video2/'.$photo.'" class="small_video_img"></img>
											</a>
										</div>
										<div class="filter_border">
											<a href="/movie_next.php?url=/video2/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
												'.$photo_base.'
											</a>
										</div>
										<div class="detail">
											<div class="hour">'.$duration.'</div>&nbsp;
											<div class="size">'.$size.'</div></br>
											<div class="viewcount">View: '.$viewcount.'</div>
											<div class="date">'.$date.'</div>&nbsp;
											<div class="promo">'.$state.'</div>&nbsp
											<div class="price">'.$fee.'</div>
											
										</div>
									</td>
								</tr>
								</tbody></table><li id="thisisid'.$id.'"></li>
						</div>'; 
			}
		}
	}
}
?>