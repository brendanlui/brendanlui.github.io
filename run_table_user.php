
<?php
include 'config_database_value.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(20),
password VARCHAR(255),
firstname VARCHAR(20),
lastname VARCHAR(20),
mobile INT(8),
hkid VARCHAR(10),
email VARCHAR(50),
property INT(6) UNSIGNED,
apply_item INT(1) UNSIGNED,
last_activity VARCHAR(20),
ip_address_used VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<?php
include 'config_database_value.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_record (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		caller VARCHAR(20),
		category NVARCHAR(10),
		title NVARCHAR(20),
		detail NVARCHAR(200),
		photo NVARCHAR(200),
		date VARCHAR(20),
		user_do_this_job VARCHAR(20),
		resolved VARCHAR(20),
		reward INT(10) UNSIGNED
		)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_record created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

