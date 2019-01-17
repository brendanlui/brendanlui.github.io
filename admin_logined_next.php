<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php include 'config_logined_admin.php';?>

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
    <style type="text/css">
        body{ font: 14px sans-serif; background: #969494;}
        .wrapper{ width: 350px; padding: 20px; }
    </style>
<title>Dadiu | Admin</title>


<body>	
	<div id="head">
	<a href="/admin_login.php">
		<div id="logo">
			<img src="/img/dadiu.png" style="width:300px;height:240px;">
		</div>
	</a>
	</div>
	<div class="first_words">Here you can order anything!</div>
	<div class="sign_out">
		<p><a href="admin_logout.php" class="btn btn-danger">Sign Out</a></p>
		<h6>*remember to sign out</h6>
	</div>
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
			if($row['photo']!=""){
				echo('
					<img id = "caller_img" src="/uploads/'.$row['photo'].'"></br>
					</div></br>
					');
			}

			echo '
				<form class="logined_next_back" action="/admin_print_all_new_notice_detail.php">
					<input type = "submit" value = "Back"></br>
				</form></br>
			';	
		
		}
		mysqli_close($conn);
		
?>
</body>

</html>