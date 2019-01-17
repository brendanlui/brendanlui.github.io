<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php include 'config_logined.php';?>

<!DOCTYPE html>
<html>
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
	<title>Dadiu | My Job</title>
</head>



<body>	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" style="width:300px;height:240px;">
		</div>
	</a>
	</div>
	<div class="first_words">Here you can order everything!</div>
	<div class="sign_out">
		<p><a href="logout.php" class="btn btn-danger">Sign Out</a></p>
		<h6>*remember to sign out</h6>
	</div>
	
<?php
		include 'config_database_value.php';
		$con=mysqli_connect($servername, $username, $password, $dbname);
		mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($con,"SELECT * FROM database_users");

		while($row = mysqli_fetch_array($result))
		{
			if( $_SESSION['username'] == $row['username']){
				echo("
				<div class='userinfo'>
					<span class='username'>ID: ".$row['username']."</span>
					<span class='coins'>Coins: ".$row['property']."<span>
				</div>
				
				");							
				break;
			}
		}
		mysqli_close($con);
?>	

<?php
				echo '
				<link id="stylecall" rel="stylesheet" href="/logined_dispear_back.css" />
					<form class="back_to_logined_next" action="/logined_next.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
					<form class="back_to_logined" action="/logined.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
				';
?>


<ul class="list">
	<div class="list_of_source" id="list_id">
		<!-- results appear here as list -->
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


//echo data
include 'config_database_value.php';
$con=mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM database_record ORDER BY date DESC");


while($row = mysqli_fetch_array($result))
{
	if(strcmp($row['user_do_this_job'], $_SESSION['username']) == 0){
		if(strcmp($row['resolved'],'Doing')==0){
				echo '				
						<div class="item" category="" style="display:block;">
								<table class="item_table"><tbody>
								<tr>
									<td>
										<div class="detail">
											
											<a href="/logined_next.php?id='.$row['id'].'" class="filter_item">
												<div class="title" id="available">'.$row['title'].'</div>
												<div class="reward" id="available">Reward: HK $'.$row['reward'].'</div>
												<div class="resolved" id="available">Status: '.$row['resolved'].'</div>
											</a>
											<div class="caller" id="available">Caller: '.$row['caller'].'</div>
											<div class="receiver">Receiver: '.$row['user_do_this_job'].'</div>
											<div class="date" id="available">'.time_elapsed_string($row['date']).'</div>
										</div>
									</td>
								</tr>
								</tbody></table>
						</div></br>
						<div class="divider1">&nbsp;</div>
						';	
		}else{
				echo '				
						<div class="item" category="" style="display:block;">
								<table class="item_table"><tbody>
								<tr>
									<td>
										<div class="detail">
											
											<a href="/logined_next.php?id='.$row['id'].'" class="filter_item">
												<div class="title" id="resolved">'.$row['title'].'</div>
												<div class="reward" id="resolved">Reward: HK $'.$row['reward'].'</div>
												<div class="resolved" id="resolved">Status: '.$row['resolved'].'</div>
											</a>
											<div class="caller" id="resolved"Caller: '.$row['caller'].'</div>
											<div class="receiver">Receiver: '.$row['user_do_this_job'].'</div>
											<div class="date" id="resolved">'.time_elapsed_string($row['date']).'</div>
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
mysqli_close($con);

?>	
	</div>
</ul>			
</body>

</html>