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
.logined_next{
	margin-top:15px;
}
form.logined_next_back{
	display:none;
}
@media screen and (max-width: 733px) {
	form.logined_next_back{
		display:block;
	}
}
</style>

<body>	
<?php 
	echo'<div class="container_right">';
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
			

		$id = $_GET['id'];
		$sql = "SELECT * FROM database_record WHERE id = '$id'";
		
		include 'config_database_value.php';
		$conn=mysqli_connect($servername, $username, $password, $dbname);
		
		mysqli_set_charset($conn, "utf8"); //view the chinese word in sql with Nvarchar
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($conn, $sql);
		
		if($result){
			while($row = mysqli_fetch_array($result))
			{
				echo('
				<div class="logined_next">
					<div class="next_topic">Title: '.$row['title'].'</div>
					<div class="next_reward">Reward: HK$'.$row['reward'].'</div>
					<div class="next_status">Status: '.$row['resolved'].'</div>
					<div class="next_detail">Detail: '.$row['detail'].'</div>
					<div class="next_caller">Caller: '.$row['caller'].'</div>
					<div class="next_receiver">Receiver: '.$row['user_do_this_job'].'</div>
					<div class="next_date">'.time_elapsed_string($row['date']).'</div>
				');
				
				echo '<link id="stylecall" rel="stylesheet" href="/logined_dispear_back.css" />
						<div class="tag">';
				$tag = explode("@", $row['category']);
				for($i = 1; $i < sizeof($tag); $i++){
					echo('
						<a target="iframe1" class="back_to_logined_next" href="/logined_next_iframe_sort_left.php?keyword_name=@'.$tag[$i].'" class="sort_button">#'.$tag[$i].'</a>
						<a target="_parent" class="back_to_logined" href="/logined.php?keyword_name=@'.$tag[$i].'" class="sort_button">#'.$tag[$i].'</a>
					');	
				}
				echo'</div></br>';
				
				if($row['photo']!=""){
					echo('
						<img id = "caller_img" src="/uploads/'.$row['photo'].'" style="width:195px;"></br>
						</div></br>
						');
				}

				if(strcmp($row['caller'], $_SESSION['username']) == 0){
					if(strcmp($row['resolved'],'Doing') == 0){
							if(strcmp($row['user_do_this_job'],'none')!=0){
								echo('
								<form target="_parent" method="post" action="/logined_change_receiver_success.php">
								<input type="hidden" name="'.$id.'">
									<input type = "submit" value = "Change Receiver"></br>
								</form></br>							  
								 '); 
								echo('
									<form target="_parent" method="post" action="/logined_resolve_success.php">
									<input type="hidden" name="'.$id.'">
										<input type = "submit" value = "Resolve Ticket"></br>
									</form></br>	
								  ');
							}
					}		  
							  
				}else{
					if(strcmp($row['user_do_this_job'],'none') == 0){
						echo('
							<form target="_parent" method="post" action="/logined_apply_success.php">
								<input type="hidden" name="'.$id.'">
								<input type = "submit" value = "Apply"></br>
							</form></br>
						  ');
					}
				}
				echo '
					<form target="_parent" class="logined_next_back" action="/logined.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
				';	
			
			}
		}
		mysqli_close($conn);
	
	echo '</div>';
?>
</body>

</html>