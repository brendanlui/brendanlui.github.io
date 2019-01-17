<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php include 'config_logined.php';?>
<HTML>
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
if($_POST){

	include 'config_database_value.php';
	$con=mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT * FROM database_record");
	
	$save_id = "";
	while($row = mysqli_fetch_array($result))
	{
		if( isset($_POST[$row['id']])){	
			$GLOBALS['save_id'] = $row['id'];
			break;
		}
	}
	
	$applied = 0;
	$person_caller = "";
	$person_receiver = "";
	$save_date = "";
	include 'config_database_value.php';
	$con=mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT * FROM database_record");
	while($row = mysqli_fetch_array($result))
	{
		if($row['id'] == $save_id) {
			if(strcmp($_SESSION['username'], $row['caller'])==0 || strcmp($row['user_do_this_job'],'none') != 0 || strcmp($row['resolved'],'Available') != 0){
				echo '
					<div class="success_reply">Apply failed.</div></br>
				';
				echo '
				<link id="stylecall" rel="stylesheet" href="/logined_dispear_back.css" />
					<form class="back_to_logined_next" action="/logined_next.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
					<form class="back_to_logined" action="/logined.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
				';

				break;
			}else{
					$applied = 1;
					$person_caller = $row['caller'];
					$person_receiver = $row['user_do_this_job'];
					$save_date = $row['date'];
			}
			break;
		}
	}	
	
	
	
		
	if($applied == 1) {
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
			if(strcmp($row['username'], $_SESSION['username']) == 0) {
				if($row['apply_item'] >= 100){
					echo '
						<div class="success_reply">Apply failed. You have already applied 100 items which are doing.</div></br>
					';
					$applied = 0;
					$person_caller = "";
					$person_receiver = "";
				}else{
						echo '
							<div class="success_reply">Apply success.</div>
						';
				}
				echo '
				<link id="stylecall" rel="stylesheet" href="/logined_dispear_back.css" />
					<form class="back_to_logined_next" action="/logined_next.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
					<form class="back_to_logined" action="/logined.php">
						<input type = "submit" value = "Back"></br>
					</form></br>
				';

				break;
			}
		}		
	}
	
	
	
	
	
		
	if($applied == 1) {
		$id = $save_id;
		
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

		$sql = "UPDATE database_record SET user_do_this_job = '".$_SESSION['username']."' WHERE id = ".$id."";

		if (mysqli_query($conn, $sql)) {
			//echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($conn);
		}

		mysqli_close($conn);
		
		
		
		
		
		$title = "";
		$id = $save_id;
		$sql = "SELECT * FROM database_record WHERE id = '$id'";
		
		include 'config_database_value.php';
		$conn=mysqli_connect($servername, $username, $password, $dbname);
		mysqli_set_charset($conn, "utf8"); //view the chinese word in sql with Nvarchar
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($conn, $sql);	/////////////get title
		while($row = mysqli_fetch_array($result))
		{
			$GLOBALS['title'] = $row['title'];
		}

		$sql = "UPDATE database_record SET resolved = 'Doing' WHERE id = ".$id."";

		if (mysqli_query($conn, $sql)) {
			//echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($conn);
		}

		mysqli_close($conn);
		
		
		
		$id = $save_id;
		$sql = "SELECT * FROM database_users WHERE username = '".$_SESSION['username']."'";
		
		include 'config_database_value.php';
		$conn=mysqli_connect($servername, $username, $password, $dbname);
		mysqli_set_charset($conn, "utf8"); //view the chinese word in sql with Nvarchar
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($conn, $sql);
		$apply_item = 0;
		while($row = mysqli_fetch_array($result))
		{
			$apply_item = $row['apply_item'] + 1;
		}

		$sql = "UPDATE database_users SET apply_item = '".$apply_item."' WHERE username = '".$_SESSION['username']."'";

		if (mysqli_query($conn, $sql)) {
			//echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($conn);
		}

		mysqli_close($conn);
		
		
		
		





//////////////get subject_mobile and object_mobile
		$subject_mobile = "";
		$object_mobile = "";
		$sql = "SELECT * FROM database_users WHERE username = '".$_SESSION['username']."'";

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
			$GLOBALS['subject_mobile'] = $row['mobile'];
		}
		mysqli_close($conn);
		
		$sql = "SELECT * FROM database_users WHERE username = '".$person_caller."'";

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
			$GLOBALS['object_mobile'] = $row['mobile'];
		}
		mysqli_close($conn);
///////////////		

	//sql save data start for all 
	//insert in database_notice
		include 'config_database_value.php';
		/* Attempt MySQL server connection. Assuming you are running MySQL
		server with default setting (user 'root' with no password) */
		$link = mysqli_connect($servername, $username, $password, $dbname);
		mysqli_set_charset($link, "utf8"); //view the chinese word in sql with Nvarchar

		// Check connection
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		// Attempt insert query execution
		
		date_default_timezone_set('Asia/Hong_Kong');
		$date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO database_notice (subject, subject_mobile, verb, object, object_mobile, title, date, read_or_unread, record_id) VALUES
		('".$_SESSION['username']."', '".$subject_mobile."', 'applied', '".$person_caller."', '".$object_mobile."', '".$title."', '".$date."', 'Unread', '".$id."')
		";
		if(mysqli_query($link, $sql)){
			//echo "Records added successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}

		// Close connection
		mysqli_close($link);
	//sql save data end	

	}
	mysqli_close($con);	

}else{
	header("location: logined.php");
}
?>

	
</body>

</HTML>	