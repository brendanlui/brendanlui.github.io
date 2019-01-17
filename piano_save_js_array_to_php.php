<?php
js_to_php_array();
	//Capture data array from AJAX and process it...
	function js_to_php_array() {
		if(isset($_POST['str_right_hand'])){	
			$str = json_decode($_POST['str_right_hand'], true); 
			//echo "str_right_hand = ".json_encode($str);	
			if(strlen(json_encode($str)) <= 100){
				echo "Upload failed. Your melody is too short.";
				echo "<script>alert('Upload Right Hand Melody failed.');</script>";
			}else if(strlen(json_encode($str)) >= 30000){
				echo "Upload failed. Your melody is too long.";
				echo "<script>alert('Upload Right Hand Melody failed.');</script>";
			}else{
				echo "Upload successfully. After refreshing the page, you can see the new melody below.";
				echo "<script>
				alert('Upload Right Hand Melody successfully.');
				</script>";
				
				include 'config_database_value.php';
				/* Attempt MySQL server connection. Assuming you are running MySQL
				server with default setting (user 'root' with no password) */
				$link = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if($link === false){
					die("ERROR: Could not connect. " . mysqli_connect_error());
				}
				$sql = "INSERT INTO database_piano_code_right (right_hand) VALUES
				('".json_encode($str)."')
				";
				if(mysqli_query($link, $sql)){
					//echo "Records added successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
				// Close connection
				mysqli_close($link);
			}
		}
				
		if(isset($_POST['str_left_hand'])){
			echo "</br>";
			$str = json_decode($_POST['str_left_hand'], true); 
			//echo "str_left_hand = ".json_encode($str);
			if(strlen(json_encode($str)) <= 100){
				echo "Upload failed. Your melody is too short.";
				echo "<script>alert('Upload Left Hand Melody failed.');</script>";
			}else if(strlen(json_encode($str)) >= 30000){
				echo "Upload failed. Your melody is too long.";
				echo "<script>alert('Upload Left Hand Melody failed.');</script>";
			}else{			
				echo "Upload successfully. After refreshing the page, you can see the new melody below.";
				echo "<script>
				alert('Upload Left Hand Melody successfully.');
				</script>";
				
				include 'config_database_value.php';
				/* Attempt MySQL server connection. Assuming you are running MySQL
				server with default setting (user 'root' with no password) */
				$link = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if($link === false){
					die("ERROR: Could not connect. " . mysqli_connect_error());
				}
				$sql = "INSERT INTO database_piano_code_left (left_hand) VALUES
				('".json_encode($str)."')
				";
				if(mysqli_query($link, $sql)){
					//echo "Records added successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
				// Close connection
				mysqli_close($link);	
			}			
		}
	}
	
?>