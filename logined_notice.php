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
	<title>Dadiu | Notice</title>
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

$result = mysqli_query($con,"SELECT * FROM database_notice ORDER BY date DESC");


while($row = mysqli_fetch_array($result))
{
	if(strcmp($row['object'], $_SESSION['username']) == 0){
		if(strcmp($row['read_or_unread'], 'Read') == 0){		
				echo '				
						<div class="item" category="" style="display:block;">
								<table class="item_table"><tbody>
								<tr>
									<td>
										<div class="detail">
											<a href="/logined_next.php?id='.$row['record_id'].'" class="filter_item">
												<div class="title" id="resolved">'.$row['subject'].' '.$row['verb'].' your ticket - '.$row['title'].'</div>
											</a>
											<div class="date" id="resolved">'.time_elapsed_string($row['date']).'</div>
											<div class="caller" id="resolved">'.$row['read_or_unread'].'</div>
										</div>
									</td>
								</tr>
								</tbody></table>
						</div></br>
						<div class="divider1">&nbsp;</div>';	
		}
		else{
				echo '				
						<div class="item" category="" style="display:block;">
								<table class="item_table"><tbody>
								<tr>
									<td>
										<div class="detail">
											<a href="/logined_next.php?id='.$row['record_id'].'" class="filter_item">
												<div class="title" id="available">'.$row['subject'].' '.$row['verb'].' your ticket - '.$row['title'].'</div>
											</a>
											<div class="date" id="available">'.time_elapsed_string($row['date']).'</div>
											<div class="caller" id="available">'.$row['read_or_unread'].'</div>
										</div>
									</td>
								</tr>
								</tbody></table>
						</div></br>
						<div class="divider1">&nbsp;</div>';	
		}
	}
}

$sql = "UPDATE database_notice SET read_or_unread = 'Read' WHERE object = '".$_SESSION['username']."'";

if (mysqli_query($con, $sql)) {
	//echo "Record updated successfully";
} else {
	echo "Error updating record: " . mysqli_error($con);
}

mysqli_close($con);
?>	
	</div>
</ul>			
</body>

</html>