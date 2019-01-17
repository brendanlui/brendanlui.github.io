<?PHP

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$user_ip = getUserIP();

//echo $user_ip; // Output IP address [Ex: 177.87.193.134]




date_default_timezone_set('Asia/Hong_Kong');
$date = date("Y-m-d H:i:s");

if(strcmp('::1', $user_ip) != 0){
	include 'config_database_value.php';
	$con=mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT * FROM database_ip ORDER BY date DESC");
	$save_count = 0;
	while($row = mysqli_fetch_array($result))
	{
		if($date != $row['date'])
			break;
		else{
			if($user_ip == $row['ip_address'])
				$GLOBALS['save_count']++;
		}
	}

	if($save_count >= 8){	
		echo("<script>
				while(true)
					alert('Sorry, the server is down.');
			</script>");
	}else{
		//sql save data start for all in database_ip
			include 'config_database_value.php';
			/* Attempt MySQL server connection. Assuming you are running MySQL
			server with default setting (user 'root' with no password) */
			$link = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if($link === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
			// Attempt insert query execution
			
			$sql = "INSERT INTO database_ip (ip_address, date, page_name) VALUES
			('".$user_ip."', '".$date."', '".basename($_SERVER['PHP_SELF'])."')
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
}
?>

<?php
//block user
$deny = array("222.186.31.153");
if (in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
   header("location: http://thisav.com/");
   exit();
} 
?>