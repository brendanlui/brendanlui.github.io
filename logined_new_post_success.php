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
	  <title>Dadiu</title>
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

if(isset($_POST['reward']))
{
	include 'config_database_value.php';
	$con=mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT * FROM database_users");
	$code_real = "";
	while($row = mysqli_fetch_array($result))
	{
		if( $_SESSION['username'] == $row['username']){	
			if(!ctype_digit ($_POST['reward'])){
				echo '
					<div class="success_reply">Post failed. Reward should be numbers.</div></br>
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

			}else{
				echo '
					<div class="success_reply">Post success.</div></br>
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

				
				//sql save data start for all in database_record
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
					
					$target_path = "uploads/";
					$target_path = $target_path . basename( $_FILES['filename']['name']); 
					if(move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
						//echo "<script type='text/javascript'>alert('File uploaded.');</script>";
					} else{
						//echo "<script type='text/javascript'>alert('There was an error uploading the file, please try again.');</script>";
					}

					$_POST['category'] = str_replace("#","@",$_POST['category']);
					$sql = "INSERT INTO database_record (caller, category, title, detail, photo, DATE, user_do_this_job, resolved, reward) VALUES
					('".$row['username']."', '".$_POST['category']."', '".$_POST['title']."', '".$_POST['detail']."', '".$_FILES['filename']['name']."', '".$date."', 'none', 'Available','".$_POST['reward']."')
					";
					if(mysqli_query($link, $sql)){
						//echo "Records added successfully.";
					} else{
						echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					}

					// Close connection
					mysqli_close($link);
				//sql save data end					
				break;
			}
		}
	}
	mysqli_close($con);
}else{
				echo '
					<div class="success_reply">Post failed.</div></br>
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
}
?>	
</body>

</HTML>	