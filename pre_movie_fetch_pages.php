<?php

if(isset($_GET['sort'])) {
	$sort = $_GET['sort'];
	if($sort == "")
		$sort = "date";
	$prepare_value = "SELECT id, video, photo, duration, size, date, state, fee, viewcount, category FROM database_movie_yes ORDER BY ".$sort." DESC LIMIT ?, ?";
}
$keyword_name = "";
if(isset($_GET['keyword_name'])){
	$keyword_name = $_GET['keyword_name'];
}
$category_name = "";
if(isset($_GET['category_name'])){
	$category_name = $_GET['category_name'];
}
$time_name = "";
if(isset($_GET['time_name'])){
	$time_name = $_GET['time_name'];
}

date_default_timezone_set('UTC');
include 'config_database_value.php';

if($keyword_name == "" && $category_name == "" && $time_name == "")
	$item_per_page = 12;
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
	$results->bind_result($id, $video, $photo, $duration, $size, $date, $state, $fee, $viewcount, $category); //bind variables to prepared statement

	//output results from database
	while($results->fetch()){ //fetch values
		if(strtolower($keyword_name) == ""){
			//cate:null, time:null
			if($category_name == "" && $time_name == ""){
					$array_video = explode('/', $video);
					$file_name = $array_video[0];
					$photo_base = explode(".", $photo);
					array_pop($photo_base);
					$photo_base = implode('.', $photo_base);
					echo '
								<div class="item" style="display:block;">
										<table class="item_table"><tbody>
										<tr>
											<td>
												<div class="img_container">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
														<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
													</a>
												</div>
												<div class="filter_border">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
										</tbody></table><li id="thisisavid'.$id.'"></li>
								</div>'; 	
			}
			//cate:not null, time:null
			elseif($category_name != "" && $time_name == ""){
				if (strpos(strtolower($category), strtolower($category_name)) !== false) {
					$array_video = explode('/', $video);
					$file_name = $array_video[0];
					$photo_base = explode(".", $photo);
					array_pop($photo_base);
					$photo_base = implode('.', $photo_base);
					echo '
								<div class="item" style="display:block;">
										<table class="item_table"><tbody>
										<tr>
											<td>
												<div class="img_container">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
														<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
													</a>
												</div>
												<div class="filter_border">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
										</tbody></table><li id="thisisavid'.$id.'"></li>
								</div>'; 
				}				
				
			}
			//cate:null, time:not null
			elseif($category_name == "" && $time_name != ""){
				if (strcmp($time_name,'yearly')==0 && strtotime($date) > strtotime('-365 day')) {
					$array_video = explode('/', $video);
					$file_name = $array_video[0];
					$photo_base = explode(".", $photo);
					array_pop($photo_base);
					$photo_base = implode('.', $photo_base);
					echo '
								<div class="item" style="display:block;">
										<table class="item_table"><tbody>
										<tr>
											<td>
												<div class="img_container">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
														<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
													</a>
												</div>
												<div class="filter_border">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
										</tbody></table><li id="thisisavid'.$id.'"></li>
								</div>'; 
				}elseif (strcmp($time_name,'monthly')==0 && strtotime($date) > strtotime('-30 day')) {
					$array_video = explode('/', $video);
					$file_name = $array_video[0];
					$photo_base = explode(".", $photo);
					array_pop($photo_base);
					$photo_base = implode('.', $photo_base);
					echo '
								<div class="item" style="display:block;">
										<table class="item_table"><tbody>
										<tr>
											<td>
												<div class="img_container">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
														<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
													</a>
												</div>
												<div class="filter_border">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
										</tbody></table><li id="thisisavid'.$id.'"></li>
								</div>'; 
				}elseif (strcmp($time_name,'weekly')==0 && strtotime($date) > strtotime('-7 day')) {
					$array_video = explode('/', $video);
					$file_name = $array_video[0];
					$photo_base = explode(".", $photo);
					array_pop($photo_base);
					$photo_base = implode('.', $photo_base);
					echo '
								<div class="item" style="display:block;">
										<table class="item_table"><tbody>
										<tr>
											<td>
												<div class="img_container">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
														<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
													</a>
												</div>
												<div class="filter_border">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
										</tbody></table><li id="thisisavid'.$id.'"></li>
								</div>'; 
				}elseif (strcmp($time_name,'daily')==0 && strtotime($date) > strtotime('-1 day')) {
					$array_video = explode('/', $video);
					$file_name = $array_video[0];
					$photo_base = explode(".", $photo);
					array_pop($photo_base);
					$photo_base = implode('.', $photo_base);
					echo '
								<div class="item" style="display:block;">
										<table class="item_table"><tbody>
										<tr>
											<td>
												<div class="img_container">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
														<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
													</a>
												</div>
												<div class="filter_border">
													<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
										</tbody></table><li id="thisisavid'.$id.'"></li>
								</div>'; 
				}				
				
			}
			//cate:not null, time:not null
			elseif($category_name != "" && $time_name != ""){
				if (strpos(strtolower($category), strtolower($category_name)) !== false) {
					if (strcmp($time_name,'yearly')==0 && strtotime($date) > strtotime('-365 day')) {
						$array_video = explode('/', $video);
						$file_name = $array_video[0];
						$photo_base = explode(".", $photo);
						array_pop($photo_base);
						$photo_base = implode('.', $photo_base);
						echo '
									<div class="item" style="display:block;">
											<table class="item_table"><tbody>
											<tr>
												<td>
													<div class="img_container">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
															<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
														</a>
													</div>
													<div class="filter_border">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
											</tbody></table><li id="thisisavid'.$id.'"></li>
									</div>'; 
					}elseif (strcmp($time_name,'monthly')==0 && strtotime($date) > strtotime('-30 day')) {
						$array_video = explode('/', $video);
						$file_name = $array_video[0];
						$photo_base = explode(".", $photo);
						array_pop($photo_base);
						$photo_base = implode('.', $photo_base);
						echo '
									<div class="item" style="display:block;">
											<table class="item_table"><tbody>
											<tr>
												<td>
													<div class="img_container">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
															<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
														</a>
													</div>
													<div class="filter_border">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
											</tbody></table><li id="thisisavid'.$id.'"></li>
									</div>'; 
					}elseif (strcmp($time_name,'weekly')==0 && strtotime($date) > strtotime('-7 day')) {
						$array_video = explode('/', $video);
						$file_name = $array_video[0];
						$photo_base = explode(".", $photo);
						array_pop($photo_base);
						$photo_base = implode('.', $photo_base);
						echo '
									<div class="item" style="display:block;">
											<table class="item_table"><tbody>
											<tr>
												<td>
													<div class="img_container">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
															<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
														</a>
													</div>
													<div class="filter_border">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
											</tbody></table><li id="thisisavid'.$id.'"></li>
									</div>'; 
					}elseif (strcmp($time_name,'daily')==0 && strtotime($date) > strtotime('-1 day')) {
						$array_video = explode('/', $video);
						$file_name = $array_video[0];
						$photo_base = explode(".", $photo);
						array_pop($photo_base);
						$photo_base = implode('.', $photo_base);
						echo '
									<div class="item" style="display:block;">
											<table class="item_table"><tbody>
											<tr>
												<td>
													<div class="img_container">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
															<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
														</a>
													</div>
													<div class="filter_border">
														<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
											</tbody></table><li id="thisisavid'.$id.'"></li>
									</div>'; 
					}	
				}					
				
			}			
		}
		else{
			//keyword
			if (strpos(strtolower($photo), strtolower($keyword_name)) !== false) {
				$array_video = explode('/', $video);
				$file_name = $array_video[0];
				$photo_base = explode(".", $photo);
				array_pop($photo_base);
				$photo_base = implode('.', $photo_base);
				echo '
							<div class="item" style="display:block;">
									<table class="item_table"><tbody>
									<tr>
										<td>
											<div class="img_container">
												<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'">
													<img src="/video/'.$file_name.'/'.$photo.'" class="small_video_img" style="height: 222px; width: 400px"></img>
												</a>
											</div>
											<div class="filter_border">
												<a href="/movie_yes_next.php?url=/video/'.$video.'&title='.$photo_base.'&id='.$id.'" class="filter_item">
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
									</tbody></table><li id="thisisavid'.$id.'"></li>
							</div>'; 
			}
		}
	}
}
?>