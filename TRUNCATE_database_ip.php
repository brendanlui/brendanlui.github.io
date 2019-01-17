
<?php
	include 'config_database_value.php';
	/* Attempt MySQL server connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password) */
	$link = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	// Attempt insert query execution
	if(mysqli_query($link, 'TRUNCATE TABLE database_ip;')){
		echo "Records deleted successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
	// Close connection
	mysqli_close($link);
?>