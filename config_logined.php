<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])||!isset($_SESSION['timestamp'])){
  header("location: login.php");
  exit;
}else{
	if(time() - $_SESSION['timestamp'] > 1440) { //subtract new timestamp from the old one //900
		echo"<script>alert('No activity within 24 minutes; please log in again.');</script>";
		unset($_SESSION['username'], $_SESSION['password'], $_SESSION['timestamp']);
		$_SESSION['logged_in'] = false;
		header("Location: login.php"); //redirect to login.php
		exit;
	} else {
		$_SESSION['timestamp'] = time(); //set new timestamp
	}	

	date_default_timezone_set('Asia/Hong_Kong');
	$date = date("Y-m-d H:i:s");
	include 'config_database_value.php';
	$conn=mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8"); //view the chinese word in sql with Nvarchar
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql = "UPDATE database_users SET last_activity = '".$date."' WHERE username = '".$_SESSION['username']."'";

	if (mysqli_query($conn, $sql)) {
		//echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn);
	
	
	
	
	
	
	
	
	
	////////////
	$user_ip = getUserIP();
	include 'config_database_value.php';
	$conn=mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8"); //view the chinese word in sql with Nvarchar
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM database_users WHERE username = '".$_SESSION['username']."'";
	$result = mysqli_query($conn, $sql);
	
	while($row = mysqli_fetch_array($result))	//save object_mobile
	{
		if (!(strpos($row['ip_address_used'], $user_ip) !== false)) {
			$sql = "UPDATE database_users SET ip_address_used = '".$row['ip_address_used'].",".$user_ip."' WHERE username = '".$_SESSION['username']."'";

			if (mysqli_query($conn, $sql)) {
				//echo "Record updated successfully";
			} else {
				echo "Error updating record: " . mysqli_error($conn);
			}
		}
	}

	mysqli_close($conn);
}
?>