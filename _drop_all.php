
<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])|| strcmp($_SESSION['username'], 'admin_brendanlui') != 0){
  header("location: admin_login.php");
  exit;
}
?>

<?php  

	$array_run = array('database_admins', 'database_comment','database_ip','database_movie_no', 'database_movie_yes','database_notice','database_record','database_users', 'database_piano_code_right', 'database_piano_code_left');

	for($i = 0; $i < sizeof($array_run); $i++){
	
		include 'config_database_value.php';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		 if(!$conn) {  
			die('Could not connect: '.mysqli_connect_error());  
		 }  
		 echo 'Connected successfully ';  
		 
		 $sql = "DROP TABLE ".$array_run[$i];
		 
		 if(mysqli_query($conn, $sql)) {  
			echo "Table is deleted successfully</br>";  
		 } else {  
			echo "Table is not deleted successfully</br>";
		 }  
		 mysqli_close($conn);  
		 
	}
?> 