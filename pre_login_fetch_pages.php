
<?php
date_default_timezone_set('Asia/Hong_Kong');
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


if(isset($_GET['sort'])) {
	$sort = $_GET['sort'];
	if($sort == "resolved")
		$sort = "resolved ASC";	
	elseif($sort == "")
		$sort = "date DESC";
	else
		$sort = $sort." DESC";
	$prepare_value = "SELECT id, caller, category, title, detail, photo, date, user_do_this_job, resolved, reward FROM database_record ORDER BY ".$sort." LIMIT ?, ?";
}
$keyword_name = "";
if(isset($_GET['keyword_name'])){
	$keyword_name = $_GET['keyword_name'];
}
	
include 'config_database_value.php';

if($keyword_name == "")
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
	$results->bind_result($id, $caller, $category, $title, $detail, $photo, $date, $user_do_this_job, $resolved, $reward); //bind variables to prepared statement

	//output results from database
	while($results->fetch()){ //fetch values
		if(strtolower($keyword_name) == ""){
			if(strcmp($resolved,'Available')==0)
				echo '	
				<div class="item" category="" style="display:block;">
						<table class="item_table"><tbody>
						<tr>
							<td>
								<div class="detail">
										<a href="/logined_next.php?id='.$id.'" class="filter_item">
											<div class="title"id="available">'.$title.'</div>
											<div class="reward"id="available">Reward: HK $'.$reward.'</div>
											<div class="resolved"id="available">Status: '.$resolved.'</div>
										</a>
											<div class="caller"id="available">Caller: '.$caller.'</div>
											<div class="receiver">Receiver: '.$user_do_this_job.'</div>									
											<div class="date"id="available">'.time_elapsed_string($date).'</div>
									</div>
							</td>
						</tr>
						</tbody></table>
				</div></br>
				 <div class="divider1">&nbsp;</div>
				 ';
			elseif(strcmp($resolved,'Doing')==0)
				echo '	
				<div class="item" category="" style="display:block;">
						<table class="item_table"><tbody>
						<tr>
							<td>
								<div class="detail">
										<a href="/logined_next.php?id='.$id.'" class="filter_item">
											<div class="title"id="doing">'.$title.'</div>
											<div class="reward"id="doing">Reward: HK $'.$reward.'</div>
											<div class="resolved"id="doing">Status: '.$resolved.'</div>
										</a>
											<div class="caller"id="doing">Caller: '.$caller.'</div>
											<div class="receiver">Receiver: '.$user_do_this_job.'</div>									
											<div class="date"id="doing">'.time_elapsed_string($date).'</div>
									</div>
							</td>
						</tr>
						</tbody></table>
				</div></br>
				 <div class="divider1">&nbsp;</div>
				 ';				
			else
				echo '	
				<div class="item" category="" style="display:block;">
						<table class="item_table"><tbody>
						<tr>
							<td>
								<div class="detail">
										<a href="/logined_next.php?id='.$id.'" class="filter_item">
											<div class="title"id="resolved">'.$title.'</div>
											<div class="reward"id="resolved">Reward: HK $'.$reward.'</div>
											<div class="resolved"id="resolved">Status: '.$resolved.'</div>
										</a>
											<div class="caller"id="resolved">Caller: '.$caller.'</div>
											<div class="receiver">Receiver: '.$user_do_this_job.'</div>									
											<div class="date"id="resolved">'.time_elapsed_string($date).'</div>
									</div>
							</td>
						</tr>
						</tbody></table>
				</div></br>
				 <div class="divider1">&nbsp;</div>
				 ';							 
				 
				 
				 
				 
				 
				 
				 
				 
				
		}else{
			if (strpos(strtolower($title), strtolower($keyword_name)) !== false|| strpos(strtolower($category), strtolower($keyword_name)) !== false) {
				echo '	
				<div class="item" category="" style="display:block;">
						<table class="item_table"><tbody>
						<tr>
							<td>
								<div class="detail">
										<a href="/logined_next.php?id='.$id.'" class="filter_item">
											<div class="title"id="'.strtolower($resolved).'">'.$title.'</div>
											<div class="reward"id="'.strtolower($resolved).'">Reward: HK $'.$reward.'</div>
											<div class="resolved"id="'.strtolower($resolved).'">Status: '.$resolved.'</div>
										</a>
											<div class="caller"id="'.strtolower($resolved).'">Caller: '.$caller.'</div>
											<div class="receiver">Receiver: '.$user_do_this_job.'</div>									
											<div class="date"id="'.strtolower($resolved).'">'.time_elapsed_string($date).'</div>
									</div>
							</td>
						</tr>
						</tbody></table>
				</div></br>
				 <div class="divider1">&nbsp;</div>
				 ';		
			}
		}
	}
}

?>