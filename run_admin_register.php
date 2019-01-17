<?php
	require_once 'config.php';
	
	$sql = "INSERT INTO database_admins (username, password, firstname, lastname, mobile, hkid, email, last_activity, ip_address_used) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$username = "admin_brendanlui";
	$password = "Gs78Ju2c";
	$email = "mhlui@connect.ust.hk";
	$mobile = "93743315";
	$firstname = "Brendan";
	$lastname = "Lui";
	$hkid = "A123456(7)";
	
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
	date_default_timezone_set('Asia/Hong_Kong');
	$date = date("Y-m-d H:i:s");
	$last_activity = $date;
	$ip_address_used = $user_ip;	
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_mobile, $param_hkid, $param_email, $param_last_activity, $param_ip_address_used);
		
		// Set parameters
		$param_username = $username;
		$param_password = $password;
		$param_password = password_hash($param_password, PASSWORD_DEFAULT); // Creates a password hash
		$param_email = $email;
		$param_mobile = $mobile;
		$param_firstname = $firstname;
		$param_lastname = $lastname;
		$param_hkid = $hkid;
		$param_last_activity = $last_activity;
		$param_ip_address_used = $ip_address_used;
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			// Redirect to login page
			echo "Admin registered.";
		} else{
			echo "Something went wrong. Please try again later.";
		}
	}
	 
	// Close statement
	mysqli_stmt_close($stmt);
?>